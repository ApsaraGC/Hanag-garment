<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
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
Route::get('user/shop', [ProductController::class, 'showShop'])->name('user.shop');
Route::get('/shop/load-more', [ProductController::class, 'loadMoreProducts']);

Route::get('user/faq',[HomeController::class,'faq'])->name('user.faq');
// Inside routes/web.php
Route::middleware('auth')->group(function() {
    // Protected routes
    Route::resource('cart', CartController::class);
});
Route::get('user/cart', [CartController::class, 'index'])->name('user.cart');
Route::post('user/cart/add', [CartController::class, 'addTocart'])->name('cart.add');
// In your routes/web.php
Route::post('/cart/{productId}/increase', [CartController::class, 'increase_cart_quantity'])->name('cart.qty.increase');
Route::post('/cart/{productId}/decrease', [CartController::class, 'decrease_cart_quantity'])->name('cart.qty.decrease');

// Route::put('user/cart/decrease-quantity/{rowId}', [CartController::class, 'decreaseCartQuantity'])->name('cart.qty.decrease');
// Route::put('user/cart/increase-quantity/{rowId}', [CartController::class, 'increaseCartQuantity'])->name('cart.qty.increase');
Route::delete('user/cart/remove/{productId}', [CartController::class, 'removeItem'])->name('cart.remove');
Route::delete('user/cart/clear', [CartController::class, 'emptyCart'])->name('cart.empty');
Route::post('user/cart/update', [CartController::class, 'updateCart'])->name('cart.update');

Route::get('user/contact', [HomeController::class, 'contact'])->name('user.contact');
Route::get('user/profile', [HomeController::class, 'profile'])->name('user.profile');
Route::post('/update-address', [ProfileController::class, 'updateAddress'])->name('update.address');

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
    // Admin route to view orders
    // Order Routes
    Route::get('/admin/orders', [OrderController::class, 'viewOrders'])->name('admin.order');
Route::get('/admin/orders/create', [OrderController::class, 'create'])->name('admin.createOrder');
Route::post('/admin/orders', [OrderController::class, 'store'])->name('admin.storeOrder');
Route::get('/admin/orders/{order}/edit', [OrderController::class, 'edit'])->name('admin.update-order');
Route::put('/admin/orders/{order}', [OrderController::class, 'update'])->name('admin.updateOrder');
Route::delete('/admin/orders/{order}', [OrderController::class, 'destroy'])->name('admin.destroyOrder');

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
Route::get('/admin/messages', [MessageController::class, 'index'])->name('admin.messages');

// Store messages
Route::post('/contact', [MessageController::class, 'store'])->name('messages.store');

// Admin route to view messages
Route::get('/admin/messages', [MessageController::class, 'index'])->middleware('auth')->name('admin.messages');
Route::get('/search', [HomeController::class, 'searchResults'])->name('user.search');

// In web.php (routes file)
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
//Route::get('/user/esewa/payment', [PaymentController::class, 'esewaPayment'])->name('user.esewa.payment');
Route::get('/user/invoice', [InvoiceController::class, 'generateInvoice'])->name('user.invoice');
Route::get('/user/esewa/payment', [PaymentController::class, 'showPaymentPage'])->name('user.esewa.payment');
// Success and failure routes for the payment
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/failure', [PaymentController::class, 'paymentFailure'])->name('payment.failure');


Route::post('/order/confirm', [OrderController::class, 'store'])->name('order.confirm');
Route::get('/order/{orderId}/checkout', [OrderController::class, 'checkout'])->name('user.orderBill');

//Route::get('user/orderBill', [OrderController::class, 'checkout'])->name('user.orderBill');
Route::get('/order/bill/download/{orderId}', [OrderController::class, 'downloadOrderBill'])->name('download.orderBill');

