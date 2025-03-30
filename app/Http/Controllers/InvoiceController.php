<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class InvoiceController extends Controller
{
    // Inside your InvoiceController or route handling the invoice page
    // public function invoice()
    // {
    //     // Get the current user's cart items from the database (assuming a UserCart model)
    //     $user = Auth::user();  // Get the logged-in user

    //     // Get cart items from the UserCart model (assuming the model is linked to the logged-in user)
    //     $cartItems = UserCart::where('user_id', $user->id)->get(); // Retrieve cart items for the user

    //     $subtotal = 0;

    //     // Loop through cart items and calculate the subtotal
    //     foreach ($cartItems as $item) {
    //         // Retrieve product from the database by its id
    //         $product = Product::find($item->product_id); // Assuming 'product_id' is the foreign key in UserCart
    //         // If the product is found, calculate subtotal for that product
    //         if ($product) {
    //             $subtotal += $product->sale_price * $item->quantity;  // Assuming 'quantity' exists in the UserCart table
    //         }
    //     }

    //     // Set a fixed delivery charge or calculate it based on conditions
    //     $deliveryCharge = 150.00;  // Static delivery charge, can be dynamic

    //     // Calculate the total
    //     $total = $subtotal + $deliveryCharge;

    //     // Retrieve the payment type (you can hardcode it or pass as needed)
    //     $paymentType = 'COD';  // Default payment type is 'COD', you can update this based on your flow

    //     // Pass the data to the view
    //     return view('user.invoice', compact('cartItems', 'subtotal', 'deliveryCharge', 'total', 'paymentType'));
    // }

    // Generate Invoice method if needed
    public function generateInvoice()
    {
        $user = Auth::user();  // Get the logged-in user

        // Get cart items from the UserCart model
        $cartItems = UserCart::where('user_id', $user->id)->get(); // Retrieve cart items for the user

        $subtotal = 0;

        // Loop through cart items and calculate the subtotal
        foreach ($cartItems as $item) {
            // Retrieve product from the database by its id
            $product = Product::find($item->product_id);  // Get product by ID
            // If the product is found, calculate subtotal for that product
            if ($product) {
                $subtotal += $product->sale_price * $item->quantity;  // Calculate price * quantity
            }
        }

        // Set a fixed delivery charge or calculate it based on conditions
        $deliveryCharge = 150.00;  // Static delivery charge, can be dynamic

        // Calculate the total
        $total = $subtotal + $deliveryCharge;

        // Retrieve the payment type (this can be dynamic based on your application logic)
        $paymentType = 'COD';  // Default payment type is 'COD'

        // Pass the data to the view
        return view('user.invoice', compact('user', 'cartItems', 'paymentType', 'subtotal', 'deliveryCharge', 'total'));
    }
}



