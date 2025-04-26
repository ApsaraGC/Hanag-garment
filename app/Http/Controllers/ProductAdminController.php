<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductAdminController extends Controller
{
    public function store(Request $request)
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

        // Create Product
        $product = new Product();
        $product->product_name = $request->product_name;
        dd($request->all());
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
            $product->image = 'build/assets/images/products/' . $fileName;
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
        return redirect()->route('admin.products')->with('popup_message', 'Product added successfully!');
    }
}
