<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\UserCart;
use Surfsidemedia\Shoppingcart\Facades\Cart;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the cart view with cart items and totals.
     */
    public function index()
    {
        // Get the cart items for the logged-in user
        $cartItems = UserCart::where('user_id', Auth::id())
        ->with('product') // Load product details
        ->get();
        // Calculate the total price and other cart details
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->sale_price * $item->quantity;
        });

        $deliveryCharge = 150; // Fixed delivery charge
        $total = $subtotal + $deliveryCharge;
        // $user = Auth()->user();
        // // Return the cart view with the necessary data
        // $order = $user->order()->latest()->first();  // Or any other method to get the order

        return view('user.cart', compact('cartItems', 'subtotal', 'deliveryCharge', 'total',));
    }

public function addToCart(Request $request)
{
    $request->validate([
        'id' => 'required|exists:products,id', // Validate product ID exists
        'quantity' => 'required|integer|min:1', // Validate quantity, though we'll default it to 1
        'name' => 'required|string',
        'price' => 'required|numeric|min:0',
    ]);

    // Check if the user is logged in
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You must be logged in to add items to the cart.');
    }
    // Find the product
    $product = Product::findOrFail($request->id);

    // Check if the product already exists in the cart
    $existingCartItem = UserCart::where('user_id', Auth::id())
        ->where('product_id', $product->id)
        ->first();

    // If product already exists in the cart, just update the quantity
    if ($existingCartItem) {
        $existingCartItem->quantity += 1; // Increase quantity by 1
        $existingCartItem->save();
    } else {
        // Add the product to the cart with quantity set to 1 by default
        $cartItem = UserCart::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'product_name' => $request->name,
            'price' => $product->sale_price,
            'quantity' => 1, // Set the default quantity to 1
            'status' => 'pending',  // Set status as pending
        ]);
    }

    // Redirect back to the cart page with success message
    return redirect()->route('user.cart')->with('success', 'Product added to cart successfully!');
}
    /**
     * Increase the quantity of a product in the cart.
     */
   // Increase the quantity of a product in the cart
   public function increase_cart_quantity($productId)
   {
       $cartItem = UserCart::where('user_id', Auth::id())
                           ->where('product_id', $productId)
                           ->first();

       // Fetch the available product quantity from the products table
       $product = Product::find($productId);

       if ($product && $cartItem) {
           // Check if the cart quantity is less than the available stock
           if ($cartItem->quantity < $product->quantity) {
               // Increase the cart quantity by 1
               $cartItem->quantity += 1;
               $cartItem->save();
               return redirect()->back()->with('popup_message', 'Product quantity updated successfully!');
           } else {
               return redirect()->back()->with('message', 'Not enough stock available!');
           }
       }

       return redirect()->back()->with('message', 'Product not found!');
   }

// Decrease the quantity of a product in the cart
public function decrease_cart_quantity($productId)
{
    $cartItem = UserCart::where('user_id', Auth::id())
                        ->where('product_id', $productId)
                        ->first();

    if ($cartItem && $cartItem->quantity > 1) {
        // Decrease the quantity by 1
        $cartItem->quantity -= 1;
        $cartItem->save();
        return redirect()->back()->with('popup_message', 'Product quantity updated successfully!');
    }

    return redirect()->back()->with('message', 'Cannot decrease quantity below 1!');
}
    /**
     * Remove an item from the cart.
     */
    public function removeItem($productId)
    {
        // Find the cart item in the database (assume it is stored in a 'user_carts' table)
        $cartItem = UserCart::where('product_id', $productId)
                            ->where('user_id', Auth::id()) // Ensure the item belongs to the logged-in user
                            ->first();

        // Check if the cart item exists
        if (!$cartItem) {
            return redirect()->route('user.cart')->with('error', 'Cart item not found.');
        }

        // Delete the cart item
        $cartItem->delete();

        // Redirect back with a success message
        return redirect()->back()->with('popup_message', 'Item removed successfully!');
    }

    /**
     * Empty the cart.
     */
    public function emptyCart()
    {
        UserCart::where('user_id', Auth::id())->where('status', 'pending')->delete();
        return redirect()->route('cart.index')->with('popup_message', 'All items removed from the cart.');
    }

    /**
     * Checkout and complete the order.
     */
    public function checkout(Request $request)
    {
        // Redirect to the invoice page or another route
        return redirect()->route('user.orderBill');
    }
}
