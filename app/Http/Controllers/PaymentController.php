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
public function showPaymentPage()
{
    $user = auth()->user();  // Get the logged-in user
    $product = Product::find(1);  // Assuming you get the product by its ID

    if (!$product) {
        // Handle the case where the product is not found
        abort(404, 'Product not found');
    }

    $paymentType = 'Credit Card';  // Example, this could be dynamic based on the user's choice

    return view('payment.invoice', [
        'user' => $user,
        'product' => $product,
        'paymentType' => $paymentType
    ]);
}


}
