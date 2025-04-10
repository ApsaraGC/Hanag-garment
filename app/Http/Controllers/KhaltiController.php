<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\order_items;
use App\Models\Payment;
use App\Models\UserCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KhaltiController extends Controller
{
    public function initiatePayment(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric|min:1',
        ]);
        $deliverycharge = 0;
        $orderId = $request->order_id;
        $amountInPaisa = ($request->amount * 100)  + $deliverycharge;
        $amount = intval($amountInPaisa); // Ensure it's an integer

        $args = [
            'return_url' => route('khalti.callback', ['order_id' => $orderId]),
            'website_url' => url('/'),
            'amount' => $amount,
            'purchase_order_id' => $orderId,
            'purchase_order_name' => 'Order #' . $orderId,
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://a.khalti.com/api/v2/epayment/initiate/');
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($args));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Key ' . config('services.khalti.secret_key'),
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return redirect()->route('user.cart')->with('error', 'Khalti payment initiation failed: ' . $err);
        }

        $response = json_decode($response, true);

        if (isset($response['payment_url'])) {
            return redirect()->away($response['payment_url']);
        } else {
            return redirect()->route('user.cart')->with('error', 'Khalti payment initiation failed: ' . json_encode($response));
        }
    }

    public function handleCallback(Request $request, $order_id)
    {
        $token = $request->token;
        $amount = $request->amount;

        $args = [
            'token' => $token,
            'amount' => $amount,
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://a.khalti.com/api/v2/payment/verify/');
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($args));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Key ' . config('services.khalti.secret_key'),
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            // Payment verification failed
            $order = Order::findOrFail($order_id);
            $order->update(['status' => 'cancelled']);
            return redirect()->route('user.orderBill', ['orderId' => $order_id])->with('error', 'Khalti payment verification failed.');
        }

        $response = json_decode($response, true);

        if (isset($response['status']) && $response['status'] === 'Completed') {
            // Payment successful
            return DB::transaction(function () use ($request, $order_id, $response) {
                $order = Order::findOrFail($order_id);
                $order->update(['status' => 'completed']);


                UserCart::where('user_id', Auth::id())->delete();

                return redirect()->route('user.orderBill', ['orderId' => $order_id])
                    ->with('popup_message', 'Payment successful! Your order is being processed.');
            });
        } else {
            // Payment verification failed
            $order = Order::findOrFail($order_id);
            $order->update(['status' => 'cancelled']);
            return redirect()->route('user.orderBill', ['orderId' => $order_id])->with('error', 'Khalti payment verification failed.');
        }
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:khalti,esewa,cod',
        ]);
        $cartItems = UserCart::where('user_id', Auth::id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('user.cart')->with('error', 'Your cart is empty.');
        }

        $totalAmount = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->sale_price;
        });

        $deliveryCharge = 150;
        $grandTotal = $totalAmount + $deliveryCharge;

        return DB::transaction(function () use ($request, $cartItems, $deliveryCharge, $grandTotal) {
            // Create the order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_date' => now(),
                'total_amount' => $grandTotal,
                'sub_total' => $grandTotal - $deliveryCharge,
                'delivery_address' => Auth::user()->address,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'description' => 'Order placed by ' . Auth::user()->full_name,
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                order_items::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->sale_price,
                    'subtotal' => $cartItem->quantity * $cartItem->product->sale_price,
                ]);
            }

            // Create payment record
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => $request->payment_method,
                'amount' => $grandTotal,
                'status' => ($request->payment_method === 'cod') ? 'pending' : 'processing',
                'payment_date' => now(),
            ]);


            // Handle redirection based on payment method
            if ($request->payment_method === 'khalti') {
                return response()->json(['order_id' => $order->id, 'amount' => $grandTotal]);
            } elseif ($request->payment_method === 'cod') {
                UserCart::where('user_id', Auth::id())->delete();
                return response()->json(['redirect_url' => route('user.orderBill', ['orderId' => $order->id]), 'message' => 'Order placed successfully for COD.']);
            }
            return redirect()->route('user.cart')->with('error', 'Invalid payment method.');
        });
    }
}
