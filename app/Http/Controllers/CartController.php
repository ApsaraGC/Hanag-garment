<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
/*************  ✨ Codeium Command ⭐  *************/
    /**
     * Display the cart view with cart items and totals.
     *
     * Retrieves the current cart items and calculates the subtotal,
/******  6aa7f1e0-ed18-438f-8eed-d8c1ffc96ac9  *******/
    public function index()
    {
    $items = Cart::instance('cart')->content();
    $subtotal = (float) str_replace(',', '', Cart::subtotal());  // Convert subtotal to a float value
    $deliveryCharge = 150;
    $total = $subtotal + $deliveryCharge;

    return view('user.cart', compact('items', 'subtotal', 'deliveryCharge', 'total'));
    }

    public function add_to_cart(Request $request)
    {
        //dd($request->id, $request->name, $request->quantity, $request->price);  // Check what's being passed

        Cart::instance('cart')->add($request->id, $request->name, $request->quantity, $request->price)->associate(Product::class);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }



    public function increase_cart_quantity($rowId)
{
    // Get the current cart item by rowId
    $product = Cart::instance('cart')->get($rowId);

    // Increase the quantity by 1
    $qty = $product->qty + 1;

    // Update the cart with the new quantity
    Cart::instance('cart')->update($rowId, $qty);

    // Redirect back to update the cart page
    return redirect()->back()->with('popup_message', 'Product Updated quantity to cart successfully!');

}

public function decrease_cart_quantity($rowId)
{
    // Get the current cart item by rowId
    $product = Cart::instance('cart')->get($rowId);

    // Decrease the quantity by 1 (make sure qty doesn't go below 1)
    $qty = $product->qty > 1 ? $product->qty - 1 : 1;

    // Update the cart with the new quantity
    Cart::instance('cart')->update($rowId, $qty);

    // Redirect back to update the cart page
    return redirect()->back()->with('popup_message', 'Product Updated to cart successfully!');
}


    public function remove_item($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        return redirect()->back()->with('popup_message', 'Item removed successfully!');

    }

    public function empty_cart()
    {
        Cart::instance('cart')->destroy();
        return redirect()->back()->with('popup_message', 'Product Removed from cart successfully!');

    }

    public function wishlist()
    {
        $items = Cart::instance('wishlist')->content();
        return view('user.wishlist', compact('items'));
    }

}
