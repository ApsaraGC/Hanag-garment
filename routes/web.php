<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserAdminController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'dashboard']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
// Route to dashboard
Route::get('/dashboard', [HomeController::class, 'dashboard'])
    // ->middleware(['auth', 'verified']) // Only authenticated users can access
    ->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   // User profile route
   Route::get('user/profile', [ProfileController::class, 'profile'])->name('user.profile');

   // User settings route
   Route::get('user/settings', [ProfileController::class, 'settings'])->name('user.settings');



});

// In web.php


require __DIR__.'/auth.php';
Route::get('admin/dashbord',[AdminController::class,'index']);
Route::get('/welcome', [HomeController::class, 'welcome']);
Route::get('user/aboutus', [HomeController::class, 'index'])->name('user.aboutus');
Route::get('user/shop', [HomeController::class, 'shop'])->name('user.shop');
// Route::get('user/cart', [HomeController::class, 'cart'])->name('user.cart');
Route::get('user/payment', [HomeController::class, 'payment'])->name('user.payment');
Route::get('user/productDetails/{id}', [ProductController::class, 'show'])->name('user.productDetails.show');
Route::get('user/faq',[HomeController::class,'faq'])->name('user.faq');
// Inside routes/web.php
Route::middleware('auth')->group(function() {
    // Protected routes
    Route::resource('cart', CartController::class);
});
Route::get('user/cart', [CartController::class, 'index'])->name('user.cart');
Route::post('user/cart/add', [CartController::class, 'add_to_cart'])->name('cart.add');
Route::put('user/cart/decrease-quantity/{rowId}', [CartController::class, 'decrease_cart_quantity'])->name('cart.qty.decrease');
Route::put('user/cart/increase-quantity/{rowId}', [CartController::class, 'increase_cart_quantity'])->name('cart.qty.increase');
Route::delete('user/cart/remove/{rowId}', [CartController::class, 'remove_item'])->name('cart.remove');
Route::delete('user/cart/clear', [CartController::class, 'empty_cart'])->name('cart.empty');
Route::post('user/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
// Route::get('user/wishlist', [CartController::class, 'wishlist'])->name('user.wishlist');

// // Add to cart route
// Route::post('cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');

// // View cart route
// Route::get('user/cart', [CartController::class, 'index'])->name('user.cart');

// // Update cart route
// Route::patch('user/cart/update/{cart}', [CartController::class, 'updateCart'])->name('cart.update');


// Route::get('user/productDetails/{id}', [HomeController::class, 'product'])->name('user.productDetails.show');
//Route::get('user/productDetails/{id}', [HomeController::class, 'showProduct'])->name('user.productDetails');

Route::get('user/contact', [HomeController::class, 'contact'])->name('user.contact');
Route::get('user/profile', [HomeController::class, 'profile'])->name('user.profile');

Route::middleware(['auth',AuthAdmin::class])->group(function(){
    Route::get('admin/navbar', [AdminController::class, 'navbar'])->name('admin.navbar');

    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/brands',[AdminController::class,'brands'])->name('admin.brands');
    Route::get('admin/add-brand',[AdminController::class,'addBrand'])->name('admin.add-brand');
    Route::post('admin/add-brand',[AdminController::class,'saveBrand'])->name('admin.saveBrand');
// Display the edit form (GET request)
    Route::get('admin/edit-brand/{id}', [AdminController::class, 'editBrand'])->name('admin.editBrand');

// Handle the form submission and update the brand (POST request)
    Route::put('admin/edit-brand/{id}', [AdminController::class, 'updateBrand'])->name('admin.updateBrand');
    Route::delete('/admin/delete-brand/{id}', [AdminController::class, 'deleteBrand'])->name('admin.deleteBrand');

    Route::get('/admin/categorys',[AdminController::class,'categories'])->name('admin.categorys');
    Route::get('admin/add-category',[AdminController::class,'addCategory'])->name('admin.add-category');
    Route::post('admin/add-category',[AdminController::class,'saveCategory'])->name('admin.saveCategory');
    Route::get('admin/edit-category/{id}',[AdminController::class,'editCategory'])->name('admin.edit-category');
    Route::put('admin/update-category/{id}', [AdminController::class, 'updateCategory'])->name('admin.updateCategory');
    Route::delete('admin/delete-category/{id}', [AdminController::class, 'deleteCategory'])->name('admin.deleteCategory');

    Route::get('admin/products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('admin/add-product', [ProductController::class, 'showAddProductForm'])->name('admin.add-product');
    Route::post('admin/add-product', [ProductController::class, 'store'])->name('admin.storeProduct');
    Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.editProducts');
    Route::put('/admin/products/{id}/update', [ProductController::class, 'update'])->name('admin.updateProducts');
    // Route::delete('/admin/products/{id}', [ProductController::class, 'delete'])->name('admin.deleteProducts');
    Route::delete('/admin/products/{id}', [ProductController::class, 'delete'])->name('admin.deleteProducts');

    // In routes/web.php


});
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('users', [UserAdminController::class, 'showUsers'])->name('admin.users');
    Route::get('search-users', [UserAdminController::class, 'searchUsers'])->name('admin.search.users');
});

use App\Http\Controllers\WishlistController;

Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('user.wishlist');
    Route::post('/wishlist/add/{product_id}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{product_id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::delete('/wishlist/clear', [WishlistController::class, 'clear'])->name('wishlist.clear');
});



