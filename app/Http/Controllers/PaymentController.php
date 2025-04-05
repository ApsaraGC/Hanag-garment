<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\UserCart;
use Carbon\Carbon;
use RemoteMerge\Esewa\Config;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Http;
// Init composer autoloader.

use RemoteMerge\Esewa\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function verifyPayment(Request $request)
    {
        $token = $request->input('token');
        $amount = $request->input('amount'); // Amount in paisa

        // 1. Verify payment with Khalti
        $secretKey = config('services.khalti.live_secret_key');
        $verificationUrl = 'https://khalti.com/api/v2/payment/verify/';
        $response = Http::post($verificationUrl, [
            'token' => $token,
            'amount' => $amount,
        ], [
            'Authorization' => 'Key ' . $secretKey,
        ]);

        if ($response->successful()) {
            $verificationData = $response->json();

            // 2. Retrieve cart information
            $cartItems = Session::get('cart', []); // Adjust how you retrieve cart items
            $totalAmount = $amount / 100; // Convert paisa to rupees
            $subTotal = 0; // Calculate subtotal based on cart items

            if (!empty($cartItems)) {
                // Calculate subtotal here
                foreach ($cartItems as $item) {
                    $subTotal += $item['product']->sale_price * $item['quantity'];
                }

                // 3. Create Order
                $order = Order::create([
                    'user_id' => auth()->id(), // Assuming user is logged in
                    'order_type' => 'online',
                    'sub_total' => $subTotal,
                    'total_amount' => $totalAmount,
                    'status' => 'completed',
                    // Add other order details
                ]);

                // 4. Create Order Items
                foreach ($cartItems as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['product']->id,
                        'quantity' => $item['quantity'],
                        'price' => $item['product']->sale_price,
                    ]);
                }

                // 5. Create Payment
                Payment::create([
                    'order_id' => $order->id,
                    'amount' => $totalAmount,
                    'payment_method' => 'khalti',
                    'payment_date' => now(),
                ]);

                // 6. Clear Cart
                Session::forget('cart'); // Adjust how you clear the cart

                // 7. Redirect with success message
                return redirect()->route('user.order.success')->with('success', 'Your order has been placed successfully!');
            } else {
                // Handle case where cart is empty
                return redirect()->route('user.cart')->with('error', 'Your cart is empty.');
            }

        } else {
            // Payment verification failed
            return redirect()->route('user.cart')->with('error', 'Khalti payment verification failed.');
        }
    }
}
