<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
//     public function welcome()
// {
//     $userName = auth()->user()->full_name; // Logged-in user's name
//     return view('welcome', compact('userName'));
// }
public function dashboard(){
        // Show only the first 4 products initially

    $products = Product::take(4)->get();

    //$products = Product::all(); // Fetch all products from the database

    $hotDeals = $this->hotDeals();

    return view('dashboard', compact('products', 'hotDeals'));


}
public function hotDeals()
{
    // Fetch the first 6 products for hot deals
    $hotDeals = Product::take(5)->get();

    // Calculate discounts for the hot deals (10% off)
    foreach ($hotDeals as $product) {
        if ($product->sale_price < $product->regular_price) {
            $product->discount_price = $product->regular_price - ($product->regular_price * 0.10);
        } else {
            $product->discount_price = $product->sale_price; // If sale price exists, use it directly
        }
    }

    return $hotDeals;
}


// Controller (e.g., ProductController.php)



public function welcome(){
    $products = Product::all(); // Fetch all products from the database
    return view('dashboard', compact('products'));
}
public  function index(){
    return view('user.aboutus');
}
public  function faq(){
    return view('user.faq');
}

public  function shop(){
    $products = Product::with('category')->get();  // Make sure you have a Product model and a category relationship defined

    return view('user.shop', compact('products'));
}
public  function cart(){
    return view('user.cart');
}
public  function payment(){
    return view('user.payment');
}
// public  function product($id){
//     // Fetch the product using the provided ID
//    // Fetch the product from the database using the provided ID
//    $product = Product::find($id);

//    // Check if the product exists
//    if (!$product) {
//        return redirect()->route('user.shop')->with('error', 'Product not found');
//    }

//    // Pass the product data to the view
//    return view('user.productDetails', compact('product','id'));
// }
public function show($productId)
{
}

public  function profile(){
    return view('user.profile');
}

public  function contact(){
    return view('user.contact');
}

}
