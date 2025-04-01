<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\UserCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class InvoiceController extends Controller
{

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

      // Create a new order in the database
      $order = new Order();  // Assuming Order is the model for storing order information
      $order->user_id = $user->id;
      $order->sub_total = $total;
    $order->total_amount = $total;
      $order->status = 'pending';  // You can modify this depending on your logic
      $order->save();

      // Pass the data to the view including the order
      return view('user.invoice', compact('user', 'cartItems', 'paymentType', 'subtotal', 'deliveryCharge', 'total', 'order'));
  }
}



