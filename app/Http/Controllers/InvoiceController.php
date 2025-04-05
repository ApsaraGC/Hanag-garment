<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\order_items;
use App\Models\Payment;
use App\Models\Product;
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

public function placeOrder(Request $request)
{
    $user = Auth::user();
    $cartItems = UserCart::where('user_id', $user->id)->get();
    $paymentMethods = $request->input('payment_method'); // Get the payment_method array

    $paymentType = null;

    if (is_array($paymentMethods) && !empty($paymentMethods)) {
        $paymentType = $paymentMethods[0]; // Get the first element
    }    if ($cartItems->isEmpty()) {
        return response()->json(['error' => 'Cart is empty'], 400);
    }

    $subtotal = 0;
    $products = [];

    foreach ($cartItems as $item) {
        $subtotal += $item->product->sale_price * $item->quantity;
        $products[] = [
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
            'price' => $item->product->sale_price,
        ];
    }

    $deliveryCharge = 150.00;
    $totalAmount = $subtotal + $deliveryCharge;

    // Store the order in the `orders` table
    $order = Order::create([
        'user_id' => $user->id,
        'sub_total' => $subtotal,
        'total_amount' => $totalAmount,
        'delivery_charge' => $deliveryCharge,
        'payment_type' => $request->paymentType ?? 'COD',
        'status' => 'pending',
        'description' => 'Order placed successfully.',

    ]);
    // Store ordered items in the `order_items` table
    foreach ($products as $product) {
        order_items::create([
            'order_id' => $order->id,
            'product_id' => $product['product_id'],
            'quantity' => $product['quantity'],
            'price' => $product['price'],
        ]);
    }
    // Create a new payment record
       Payment::create([
        'order_id' => $order->id,
        'amount' => $totalAmount,
        'payment_method' => $paymentType,
        'payment_date' => now(), // You might want to adjust this based on actual payment completion
    ]);

    // Clear the user's cart after placing the order
    UserCart::where('user_id', $user->id)->delete();
      // Redirect to the orderBill route after confirmation
    return redirect()->route('user.orderBill', ['orderId' => $order->id]);
    // return response()->json(['order_id' => $order->id]);
}
public function orderBill($orderId)
{
    $order = Order::with('order_items.product')->findOrFail($orderId);
    $user = Auth::user();
    return view('user.orderBill', compact('order', 'user'));
}
}
