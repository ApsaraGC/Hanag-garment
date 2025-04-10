<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\order_items;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Facades\Http; // If you're using Laravel's HTTP client

use App\Models\UserCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class InvoiceController extends Controller
{

public function generateInvoice(Request $request)
{
    $user = Auth::user();
    $cartItems = UserCart::where('user_id', $user->id)->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('user.cart')->with('error', 'Your cart is empty!');
    }

    $subtotal = 0;
    foreach ($cartItems as $item) {
        $product = Product::find($item->product_id);
        if ($product) {
            $subtotal += $product->sale_price * $item->quantity;
        }
    }

    $deliveryCharge = 150.00;
    $total = $subtotal + $deliveryCharge;
    $paymentType = $request->input('paymentType'); // Attempt to get paymentType from the request

    // If paymentType is not in the request (e.g., initial load), you can set a default
    if (!$paymentType) {
        $paymentType = 'COD';
    }
    // $paymentType = 'COD';

    return view('user.invoice', compact('user', 'cartItems', 'paymentType', 'subtotal', 'deliveryCharge', 'total'));
}

// public function placeOrder(Request $request)
// {
//     $paymentMethod = $request->input('payment_method');

//     if (!$paymentMethod) {
//         return response()->json(['error' => 'Please select a valid payment method'], 400);
//     }

//     $user = Auth::user();
//     $cartItems = UserCart::where('user_id', $user->id)->get();

//     if ($cartItems->isEmpty()) {
//         return response()->json(['error' => 'Cart is empty'], 400);
//     }

//     $subtotal = 0;
//     $products = [];

//     foreach ($cartItems as $item) {
//         $subtotal += $item->product->sale_price * $item->quantity;
//         $products[] = [
//             'product_id' => $item->product_id,
//             'quantity' => $item->quantity,
//             'price' => $item->product->sale_price,
//         ];
//     }

//     $deliveryCharge = 150.00;
//     $totalAmount = $subtotal + $deliveryCharge;

//     $order = Order::create([
//         'user_id' => $user->id,
//         'oder_type'=>$paymentMethod,
//         'sub_total' => $subtotal,
//         'total_amount' => $totalAmount,
//         'delivery_charge' => $deliveryCharge,
//         'payment_type' => $paymentMethod,
//         'status' => 'pending',
//         'description' => 'Order placed successfully.',
//     ]);

//     foreach ($products as $product) {
//         order_items::create([
//             'order_id' => $order->id,
//             'product_id' => $product['product_id'],
//             'quantity' => $product['quantity'],
//             'price' => $product['price'],
//         ]);
//     }

//     Payment::create([
//         'order_id' => $order->id,
//         'amount' => $totalAmount,
//         'payment_method' => $paymentMethod,
//         'payment_date' => now(),
//     ]);
//     UserCart::where('user_id', $user->id)->delete();



//      if ($paymentMethod === 'cod') {
//         return redirect()->route('user.orderBill', ['orderId' => $order->id]);
//     }

//     return redirect()->route('user.orderBill', ['orderId' => $order->id]);
// }


public function orderBill($orderId)
{
    $order = Order::with('order_items.product')->findOrFail($orderId);
    $user = Auth::user();
    return view('user.orderBill', compact('order', 'user'));
}

// public function showKhaltiPaymentForm($orderId)
// {
//     $order = Order::findOrFail($orderId);

//     // Prepare Khalti payment data (make sure this data is valid and appropriate for Khalti API)
//     $apiUrl = 'https://khalti.com/api/v2/epayment/initiate/';

//     $secretKey = env('KHALTI_LIVE_SECRET_KEY');  // Store your key in .env

//     // Send the POST request to initiate Khalti payment
//     $response = Http::withHeaders([
//         'Authorization' => 'Key ' . $secretKey
//     ])->post($apiUrl, [
//         'amount' => $order->total_amount * 100, // Amount in paisa
//         'product_identity' => 'Order-' . $order->id,
//         'product_name' => 'Product for Order ' . $order->id,
//         'product_url' => route('user.orderBill', ['orderId' => $order->id]),
//     ]);

//     if ($response->successful()) {
//         $data = $response->json();
//         return view('user.khalti', [
//             'token' => $data['token'],
//             'amount' => $order->total_amount,
//             'order' => $order
//         ]);
//     } else {
//         return back()->with('error', 'Failed to initiate payment');
//     }
// }

}
