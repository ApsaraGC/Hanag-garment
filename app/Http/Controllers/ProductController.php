<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class ProductController extends Controller
{
  /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        // dd($search);
        if ($search) {
            $products = Product::query() // Start with a query builder instance
                ->where('product_name', 'like', '%' . $search . '%')
                ->orWhere('color', 'like', '%' . $search . '%')
                ->orWhere('regular_price', 'like', '%' . $search . '%')
                ->orWhere('sale_price', 'like', '%' . $search . '%')
                ->orWhereHas('category', function ($query) use ($search) {
                    $query->where('category_name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('brand', function ($query) use ($search) {
                    $query->where('brand_name', 'like', '%' . $search . '%');
                })
                ->paginate(8);
        } else {
            // No search term, show all products
            $products = Product::paginate(8);
        }

        return view('admin.products', compact('products', 'search'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
     // Validate Request
     $request->validate([
        'product_name' => 'required|string|max:255',
        'short_description' => 'required|string',
        'description' => 'nullable|string',
        'regular_price' => 'required|numeric',
        'sale_price' => 'nullable|numeric',
        'stock_status' => 'required|in:instock,outofstock',
        'quantity' => 'required|integer|min:1',
        'color' => 'nullable|string',
        'size' => 'nullable|string',
        'is_featured' => 'nullable',
        'category_id' => 'nullable|exists:categories,id',
        'brand_id' => 'nullable|exists:brands,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Create Product
    $product = new Product();
    $product->product_name = $request->product_name;
    $product->short_description = $request->short_description;
    $product->description = $request->description;
    $product->regular_price = $request->regular_price;
    $product->sale_price = $request->sale_price;
    $product->stock_status = $request->stock_status;
    $product->quantity = $request->quantity;
    $product->is_featured = ($request->is_featured == 'on') ? 1 : 0; // Ensure it's always set to false if not checked
    $product->color = $request->color;
    $product->size = $request->size;
    $product->category_id = $request->category_id;
    $product->brand_id = $request->brand_id;
    // Handle Single Image Upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $fileName = Carbon::now()->timestamp . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('build/assets/images/products'), $fileName);
        $product->image = 'build/assets/images/products/'.$fileName;
    }
   // Handle Multiple Image Uploads
   $allImagesPaths = [];  // Create an empty array to store multiple images
   if ($request->hasFile('images')) {
       foreach ($request->file('images') as $img) {
           // Generate a unique name for each image
           $imageName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $img->getClientOriginalExtension();

           // Move the image to the 'public/images/products' directory
           $img->move(public_path('build/assets/images/products'), $imageName);

           // Add the image path to the array
           $allImagesPaths[] = 'build/assets/images/products/' . $imageName;  // Store the relative path
       }
   }
   // Check if there are any images to save
   if (!empty($allImagesPaths)) {
       // Store the images as a JSON string in the database
       $product->images = $allImagesPaths;
   }
   // Save the product to the database
   $product->save();
    // Redirect to the products page with success message
    return redirect()->route('admin.products')->with('success', 'Product added successfully!');
}


public function showShop(Request $request)
{
    $brands = Brand::all();
    $categories = Category::all(); // Fetch all categories
    $sort = $request->query('sort', 'default');
    $priceSort = ($sort == 'price-asc') ? 'asc' : 'desc';
    // Start the query builder
    $products = Product::query();

    if ($sort) {
        $products = $products->orderBy('sale_price', $priceSort);
    }
    // Handle search
    $search = $request->input('search');

    if ($search) {
        $products = $products->where('product_name', 'like', '%' . $search . '%')
            ->orWhere('color', 'like', '%' . $search . '%')
            ->orWhere('regular_price', 'like', '%' . $search . '%')
            ->orWhere('sale_price', 'like', '%' . $search . '%')
            ->orWhereHas('category', function ($query) use ($search) {
                $query->where('category_name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('brand', function ($query) use ($search) {
                $query->where('brand_name', 'like', '%' . $search . '%');
            });
    }
    // Apply sorting if needed
    if ($sort == 'price-asc') {
        $products = $products->orderBy('sale_price', 'asc');
    } elseif ($sort == 'price-desc') {
        $products = $products->orderBy('sale_price', 'desc');
    } else {
        $products = $products->orderBy('created_at', 'desc'); // Default sorting
    }
    // Apply pagination
    $products = $products->paginate(8)->appends(request()->query()); // This will work

    return view('user.shop', compact('brands', 'categories', 'products', 'sort', 'search'));
}


 /**
     * Display the specified resource.
     */
    public function showAddProductForm()
 {
    $categories = Category::all(); // Ensure Category model is correctly imported
    $brands = Brand::all(); // If you are also
     return view('admin.add-product',compact('categories','brands'));
 }

 public function show($productId)
{
    $product = Product::with(['category', 'brand', 'reviews'])->findOrFail($productId);
    // Calculate average rating
    $averageRating = $product->reviews->avg('rating');
    $relatedProducts = Product::where('category_id', $product->category_id)->limit(4)->get();
    return view('user.productDetails', compact('product', 'relatedProducts', 'averageRating'));
}

public function submitRating(Request $request)
{
     // Check if the user is logged in
     if (!auth()->check()) {
        // If not logged in, redirect to login page with a message
        return redirect()->route('login')->with('error', 'Please log in to submit a rating.');
    }
    // Validate the incoming request
    $request->validate([
        'rating' => 'required|integer|between:1,5',
        'product_id' => 'required|exists:products,id', // Ensure product_id is valid
    ]);
    // Get the logged-in user
    $user = auth()->user();
    // Find the product
    $product = Product::find($request->input('product_id'));

    if (!$product) {
        return redirect()->back()->with('error', 'Product not found.');
    }
    // Check if the user has already reviewed the product
    $existingReview = Review::where('product_id', $product->id)
        ->where('user_id', $user->id)
        ->first();
    if ($existingReview) {
        // If review exists, update it
        $existingReview->rating = $request->input('rating');
        $existingReview->save();
    } else {
        // If no review, create a new one
        $product->reviews()->create([
            'user_id' => $user->id,
            'rating' => $request->input('rating'),
        ]);
    }
    // Redirect back with a success message
    return redirect()->back()->with('success', 'Rating submitted successfully!');
}

/**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {

        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.editProduct', compact('product', 'categories', 'brands'));
    }
    /**
 * Update the specified resource in storage.
 */
public function update(Request $request, string $id)
{
    // Validate Request
    $request->validate([
        'product_name' => 'required|string|max:255',
        'short_description' => 'required|string',
        'description' => 'nullable|string',
        'regular_price' => 'required|numeric',
        'sale_price' => 'nullable|numeric',
        'stock_status' => 'required|in:instock,outofstock',
        'quantity' => 'required|integer|min:1',
        'color' => 'nullable|string',
        'size' => 'nullable|string',
        'is_featured' => 'nullable',
        'category_id' => 'nullable|exists:categories,id',
        'brand_id' => 'nullable|exists:brands,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    // Find the product by ID
    $product = Product::findOrFail($id);
    // Update product details
    $product->product_name = $request->product_name;
    $product->short_description = $request->short_description;
    $product->description = $request->description;
    $product->regular_price = $request->regular_price;
    $product->sale_price = $request->sale_price;
    $product->stock_status = $request->stock_status;
    $product->quantity = $request->quantity;
    $product->is_featured = ($request->is_featured == 'on') ? 1 : 0; // Ensure it's always set to false if not checked
    $product->color = $request->color;
    $product->size = $request->size;
    $product->category_id = $request->category_id;
    $product->brand_id = $request->brand_id;

    // Handle Single Image Upload (if new image is uploaded)
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $fileName = Carbon::now()->timestamp . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('build/assets/images/products'), $fileName);
        $product->image = 'build/assets/images/products/'.$fileName;
    }
    $allImagesPaths = [];  // Create an empty array to store multiple images
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $img) {
            // Generate a unique name for each image
            $imageName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $img->getClientOriginalExtension();

            // Move the image to the 'public/images/products' directory
            $img->move(public_path('build/assets/images/products'), $imageName);

            // Add the image path to the array
            $allImagesPaths[] = 'build/assets/images/products/' . $imageName;  // Store the relative path
        }
    }
    // Check if there are any images to save
     // Check if there are any images to save
    if (!empty($allImagesPaths)) {
    // Store the images as a JSON string in the database
    $product->images = $allImagesPaths;
    }

    // Save the updated product to the database
    $product->save();
    // Redirect to the products page with success message
    return redirect()->route('admin.products')->with('popup_message', 'Product updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
   /**
 * Remove the specified resource from storage.
 */
public function destroy(string $id)

    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products')->with('popup_message', 'Product deleted successfully!');
    }

}
