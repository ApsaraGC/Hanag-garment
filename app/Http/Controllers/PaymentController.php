<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function esewaPayment()
{
    // You can implement the eSewa payment API integration here
    return view('user.esewa.payment');
}
public function showPaymentPage(Request $request)
{
    $user = auth()->user();  // Get the logged-in user
    $cartItems = $user->UserCart;  // Get cart items from the logged-in user's cart
    $subtotal = 0;

    // Loop through the cart items to calculate the subtotal
    foreach ($cartItems as $item) {
        $subtotal += $item->product->sale_price * $item->quantity;
    }

    $deliveryCharge = 50;  // Example: Static value
    $total = $subtotal + $deliveryCharge;


    // Handle any errors, for example:
    $errorMessage = null;
    // If eSewa service is unavailable, we can pass the message
    // If you are setting this manually or based on some API status, it should be assigned to $errorMessage.

    // Generate unique transaction ID and signature as usual
    $transactionUuid = uniqid('txn_');
    $data = "total_amount" . $total . "transaction_uuid" . $transactionUuid . "product_code" . "EPAYTEST";
    $secretKey = "8gBm/:&EnhH.1/q( ";
    $signature = base64_encode(hash_hmac('sha256', $data, $secretKey, true));

    // Success and failure URLs
    $successUrl = route('payment.success');
    $failureUrl = route('payment.failure');

    // Return the view with all data and the error message
    return view('user.esewa.payment', [
        'user' => $user,
        'cartItems' => $cartItems,
        'subtotal' => $subtotal,
        'deliveryCharge' => $deliveryCharge,
        'total' => $total,
        'signature' => $signature,
        'successUrl' => $successUrl,
        'failureUrl' => $failureUrl,
        'error_message' => $errorMessage // Pass error message
    ]);
}



public function paymentSuccess()
{
    // Handle successful payment, e.g., show a success page or update the database
    return view('user.esewa.payment_success');
}

public function paymentFailure()
{
    // Handle payment failure, e.g., show an error page or log the issue
    return view('user.esewa.payment_failure');
}
}
