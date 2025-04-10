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
public function dashboard(Request $request){
        // Show only the first 4 products initially

        $products = Product::latest()->take(5)->get(); // Order by creation date (latest products first)

    //$products = Product::all(); // Fetch all products from the database
    $search = $request->input('search', ''); // Default to an empty string if no search term is provided

    $hotDeals = $this->hotDeals();

    return view('dashboard', compact('products', 'hotDeals','search'));


}
// public function searchResults(Request $request)
// {
//     // Get the search query from the request
//     $search = $request->input('search');

//     if ($search) {
//         $products = Product::where('product_name', 'like', '%' . $search . '%')
//             ->orWhere('color', 'like', '%' . $search . '%')
//             ->orWhere('regular_price', 'like', '%' . $search . '%')
//             ->orWhere('sale_price', 'like', '%' . $search . '%')
//             ->orWhereHas('category', function ($query) use ($search) {
//                 $query->where('category_name', 'like', '%' . $search . '%');
//             })
//             ->orWhereHas('brand', function ($query) use ($search) {
//                 $query->where('brand_name', 'like', '%' . $search . '%');
//             })
//             ->get();
//     } else {
//         $products = collect(); // Return an empty collection if no search term is entered
//     }

//     return view('user.search', compact('products', 'search'));
// }

public function hotDeals()
{
    // Fetch the first 6 products for hot deals
    $hotDeals = Product::take(5)->get();

    // Calculate discounts for the hot deals (10% off)
   // Calculate discounts for the hot deals (10% off) if no sale price is set
   foreach ($hotDeals as $product) {
    if (empty($product->sale_price) || $product->sale_price >= $product->regular_price) {
        // If sale price is not set or sale price is greater than or equal to regular price, apply a 10% discount
        $product->discount_price = $product->regular_price - ($product->regular_price * 0.10);
    } else {
        // If sale price exists and is less than regular price, use the sale price directly
        $product->discount_price = $product->sale_price;
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

public function show($productId)
{
}

public  function profile(){
    return view('user.profile');
}

public  function contact(){
    return view('user.contact');
}

public function policy(){
    return view('user.policy');
}

public function privilege(){
    return view('user.privilege');
}

}
