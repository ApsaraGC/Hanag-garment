<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function navbar(){
        return view('admin.navbar');
    }
    //
    public  function index(){
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalBrands = Brand::count();
        $totalOrders = Order::count();
        $totalEarnings = Payment::sum('amount'); // Assuming `total_price` stores order revenue
        // Fetch product count per category
        $categories = Category::withCount('products')->get();

        // Filter Revenue Based on Payment Type
        $pendingRevenue = Payment::where('payment_method', 'cod')->sum('amount');
        $onlineRevenue = Payment::where('payment_method', 'khalti')->sum('amount');
          // ✅ Get recent 5 or 10 orders with related data
    $recentOrders = Order::with(['user', 'products'])->latest()->take(5)->get();

    // Fetch brands with product count
    $brands = Brand::withCount('products')->get();
        return view('admin.dashboard',compact('totalUsers', 'onlineRevenue','pendingRevenue','totalProducts', 'totalBrands', 'totalOrders', 'categories','brands','totalEarnings','recentOrders'));
    }

    public function brands(Request $request)
{
    $search = $request->input('search');
    if ($search) {
        $brands = Brand::where('brand_name', 'like', '%' . $search . '%')
                       ->orderBy('id', 'DESC')
                       ->paginate(4);
    } else {
        $brands = Brand::orderBy('id', 'DESC')->paginate(5);
    }
    return view('admin.brands', compact('brands', 'search'));
}


    public function addBrand(){

        return view('admin.add-brand');
    }
    public function saveBrand(Request $request){
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'image' => 'required|mimes:jpg,png,jpeg|max:2048'
        ]);

        $brand = new Brand();
        $brand->brand_name = $request->brand_name;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = Carbon::now()->timestamp . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('build/assets/images/brands'), $fileName);
            $brand->image = $fileName;  // Correct column name from migration
        }
        $brand->save(); // Ensure data is saved in the database
        return redirect()->route('admin.brands')->with('popup_message', 'Brand Added Successfully');
    }

public function editBrand($id)
{
    $brand = Brand::findOrFail($id);
    return view('admin.edit-brand', compact('brand', 'id'));
}

// Handle the form submission (Update brand)
public function updateBrand(Request $request, $id)
{
    $request->validate([
        'brand_name' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $brand = Brand::findOrFail($id);
    $brand->brand_name = $request->brand_name;
    // Update brand name if provided
    if ($request->has('brand_name') && $request->brand_name !== null) {
        $brand->brand_name = $request->brand_name;
    }
    // Handle Image Upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $fileName = Carbon::now()->timestamp . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('build/assets/images/brands'), $fileName);
        $brand->image = $fileName;  // Correct column name from migration
    }
    $brand->save();
    return redirect()->route('admin.brands')->with('popup_message', 'Brand updated successfully!');
}
public function deleteBrand($id)
{
    $brand = Brand::findOrFail($id);
    // Delete the image file from the server if it exists
    if ($brand->image && file_exists(public_path('images/brands/' . $brand->image))) {
        unlink(public_path('images/brands/' . $brand->image));
    }
    // Delete the brand record from the database
    $brand->delete();

    return redirect()->route('admin.brands')->with('popup_message', 'Brand deleted successfully!');
}


public function categories(){
    $categories= Category::orderBy('id','DESC')->paginate(10);
    return view('admin.category',compact('categories'));
}
public function addCategory(){

    return view('admin.add-category');
}
public function saveCategory(Request $request){

    $request->validate([
        'category_name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Validate image
    ]);

    $category = new Category();
    $category->category_name = $request->category_name;
    $category->description=$request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = Carbon::now()->timestamp . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('build/assets/images/brands'), $fileName);
            $category->image = $fileName;  // Correct column name from migration
        }
        $category->save(); // Ensure data is saved in the database
    return redirect()->route('admin.categorys')->with('popup_message', 'Category Added Successfully');
}

public function editCategory($id){
    $category = Category::findOrFail($id);
    return view('admin.edit-category',compact('category'));
}
// Update the Category
public function updateCategory(Request $request, $id)
{
    $request->validate([
        'category_name' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Validate image
    ]);

    // Retrieve the existing category
    $category = Category::findOrFail($id);

    // Handle image upload if present
    $category->category_name = $request->category_name;
    $category->description=$request->description;
    // Update brand name if provided
    if ($request->has('category_name') && $request->category_name !== null) {
        $category->category_name = $request->category_name;
    }
    // Handle Image Upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $fileName = Carbon::now()->timestamp . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('build/assets/images/brands'), $fileName);
        $category->image = $fileName;  // Correct column name from migration
    }
    $category->save();
    // // Update the category record with the new or retained image
    // $category->update([
    //     'category_name' => $request->category_name,
    //     'description' => $request->description,
    //     'image' => $imageUrl,  // Save image path in the database
    // ]);

    // Debugging check: Make sure the category has been updated
    // dd($category);

    return redirect()->route('admin.categorys')->with('popup_message', 'Category Updated Successfully');
}


// Delete the Category
 public function deleteCategory($id)
 {
     $category = Category::findOrFail($id);
     $category->delete();

     return redirect()->route('admin.categorys')->with('popup_message', 'Category Deleted Successfully');
    }
// AdminController.php

public function showRatings()
{
    // Get the products along with their reviews and user data
    $products = Product::with(['reviews.user', 'brand'])->get();

    // Group products by brand_id, then calculate average rating from the reviews
    $brandRatings = $products->groupBy('brand_id')->map(function ($group) {
        $brandName = $group->first()->brand->brand_name;

        // Calculate the average rating
        $averageRating = $group->flatMap(function ($product) {
            return $product->reviews->pluck('rating');
        })->avg();

        return [
            'brand_name' => $brandName,
            'average_rating' => $averageRating
        ];
    });

    // Collect all product reviews with users
    $productReviews = $products->flatMap(function ($product) {
        return $product->reviews->map(function ($review) use ($product) {
            return [
                'product_name' => $product->product_name,
                'full_name' => $review->user->full_name,
                'rating' => $review->rating,
                'message' => $review->message,
            ];
        });
    });

    // Pass the data to the view
    return view('admin.rating', compact('brandRatings', 'productReviews'));
}


}
