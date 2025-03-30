<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
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

    // Check if search term is provided
    if ($search) {
        $products = Product::where('product_name', 'like', '%' . $search . '%')
                           ->orWhere('category_name', 'like', '%' . $search . '%')
                           ->orWhere('brand_name', 'like', '%' . $search . '%')
                           ->orWhere('sale_price', 'like', '%' . $search . '%')
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

// public function showShop()
// {
//     $brands = Brand::all(); // Retrieve all brands from the database
//     $products = Product::all(); // Retrieve all products
//     return view('user.shop', compact('brands', 'products'));
// }

public function showShop(Request $request)
{
    $brands = Brand::all();

    // Check if sorting is requested
    $sort = $request->query('sort', 'default');

    if ($sort === 'price-asc') {
        $products = Product::orderBy('sale_price', 'asc')->get();
    } elseif ($sort === 'price-desc') {
        $products = Product::orderBy('sale_price', 'desc')->get();
    } else {
        $products = Product::all();
    }

    return view('user.shop', compact('brands', 'products', 'sort'));
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
        // Eager load category and brand relationships
        $product = Product::with(['category', 'brand'])->findOrFail($productId);

        // Fetch related products (for example, products in the same category)
        $relatedProducts = Product::where('category_id', $product->category_id)->limit(4)->get();
        return view('user.productDetails', compact('product', 'relatedProducts',));
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
