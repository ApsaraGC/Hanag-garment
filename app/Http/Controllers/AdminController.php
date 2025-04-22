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
    // Fetch brands with product count
    $brands = Brand::withCount('products')->get();
        return view('admin.dashboard',compact('totalUsers', 'onlineRevenue','pendingRevenue','totalProducts', 'totalBrands', 'totalOrders', 'categories','brands','totalEarnings'));
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
        'description' => 'nullable|string|max:255',

    ]);

    Category::create([
        'category_name' => $request->category_name,
        'description' => $request->description,
    ]);

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
    ]);

    $category = Category::findOrFail($id);
    $category->update([
        'category_name' => $request->category_name,
        'description' => $request->description,
    ]);

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
    // Get the products along with their reviews
$products = Product::with(['reviews', 'brand'])->get();

// Group products by brand_id, then calculate average rating from the reviews
$brandRatings = $products->groupBy('brand_id')->map(function ($group) {
    // Get the brand name (assuming 'brand' relationship is set up correctly in the Product model)
    $brandName = $group->first()->brand->brand_name;

    // Get all the reviews for the products in this brand group, and calculate the average rating
    $averageRating = $group->flatMap(function ($product) {
        return $product->reviews->pluck('rating');
    })->avg();

    return [
        'brand_name' => $brandName,
        'average_rating' => $averageRating
    ];
});
    // Pass to the view
    return view('admin.rating', compact('brandRatings'));
}

}
