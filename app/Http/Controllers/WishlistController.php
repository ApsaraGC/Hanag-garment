<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;

class WishlistController extends Controller
{
    // Display wishlist for the logged-in user
    public function index()
    {
        $items = Wishlist::where('user_id', Auth::id())->get();
        return view('user.wishlist', compact('items'));
    }

    // Add a product to the wishlist
    public function add($product_id)
    {
        $product = Product::findOrFail($product_id);

        // Check if the product is already in the user's wishlist
        if (Wishlist::where('user_id', Auth::id())->where('product_id', $product->id)->exists()) {
            return redirect()->route('user.wishlist')->with('popup_message', 'Product is already in your wishlist!');
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id
        ]);

        return redirect()->route('user.wishlist')->with('popup_message', 'Product added to your wishlist!');
    }

    // Remove a product from the wishlist
    public function remove($product_id)
    {
        Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->delete();
        return redirect()->route('user.wishlist')->with('popup_message', 'Product removed from your wishlist!');
    }

    // Clear all products from the wishlist
    public function clear()
    {
        Wishlist::where('user_id', Auth::id())->delete();
        return redirect()->route('user.wishlist')->with('popup_message', 'Wishlist cleared!');
    }
}
