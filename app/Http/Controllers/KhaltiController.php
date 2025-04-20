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
        $pidx = $request->get('pidx');
        $orderId = $order_id; // use the route param

        // $orderId = $request->get('order_id');
        if (!$pidx || !$orderId) {
            return redirect()->route('user.cart')->with('error', 'Missing payment identifier or order ID.');
        }

        $args = [
            'pidx' => $pidx,
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://a.khalti.com/api/v2/epayment/lookup/');
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
        //  dd($response);
        if ($err || empty($response)) {
            return redirect()->route('user.cart')->with('error', 'Payment verification failed.');
        }
        $response = json_decode($response, true); // ✅ decode it

        if (isset($response['status']) && $response['status'] === 'Completed') {
            $order = Order::find($orderId); // ✅ Correct way to fetch the order

            if (!$order) {
                return redirect()->route('user.cart')->with('error', 'Order not found.');
            }

            // ✅ Avoid duplicate payment entry
            $existing = Payment::where('order_id', $order->id)->first();
            if (!$existing) {
                Payment::create([
                    'order_id' => $order->id,
                    'payment_method' => 'khalti',
                    'amount' => $order->total_amount,
                    'status' => 'completed',
                    'payment_date' => now(),
                ]);
            }
            // dd($Payment);

            // ✅ Clear user's cart
            // UserCart::where('user_id', $order->user_id)->delete();

            return redirect()->route('user.orderBill', ['orderId' => $order->id])
                ->with('popup_message', 'Payment successful! Your order has been placed.');
        } else {
            return redirect()->route('user.cart')->with('error', 'Khalti payment verification failed.');
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
        // Create the order and other related records without DB transactions
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_date' => now(),
            'total_amount' => $grandTotal,
            'sub_total' => $grandTotal - $deliveryCharge,
            'delivery_address' => Auth::user()->address,
            'status' => ($request->payment_method === 'cod') ? 'pending' : 'completed',
            'payment_method' => $request->payment_method,
            'order_type' => ($request->payment_method === 'cod') ? 'cod' : 'khalti',
            'description' => 'Order placed by ' . Auth::user()->full_name,
        ]);
        foreach ($cartItems as $cartItem) {
            order_items::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->sale_price,
                'subtotal' => $cartItem->quantity * $cartItem->product->sale_price,
            ]);
        }
        if ($request->payment_method === 'cod') {
            // Insert into payments table for COD
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => 'cod',
                'amount' => $grandTotal,
                'status' => 'pending',
                'payment_date' => now(),
            ]);
        }
        if ($request->payment_method === 'khalti') {
            UserCart::where('user_id', Auth::id())->delete();
            return response()->json(['order_id' => $order->id, 'amount' => $grandTotal]);
        } elseif ($request->payment_method === 'cod') {
            UserCart::where('user_id', Auth::id())->delete();
            return response()->json(['redirect_url' => route('user.orderBill', ['orderId' => $order->id]), 'message' => 'Order placed successfully for COD.']);
        }
        return redirect()->route('user.cart')->with('error', 'Invalid payment method.');
    }
}
