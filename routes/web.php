<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\EsewaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\KhaltiController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserAdminController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Colors\Profile;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'dashboard']);


Route::get('/dashboard', [HomeController::class, 'dashboard'])
    // ->middleware(['auth', 'verified']) // Only authenticated users can access
    ->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // User profile route
    // Route::get('user/profile', [ProfileController::class, 'profile'])->name('user.profile');
    Route::put('/settings/update-profile', [SettingController::class, 'updateProfile'])->name('settings.updateProfile');

    // User settings route
    Route::get('user/settings', [ProfileController::class, 'settings'])->name('user.settings');
    Route::middleware(['auth'])->group(function () {
        Route::get('/invoice', [InvoiceController::class, 'generateInvoice'])->name('user.invoice');
        Route::post('/place-order', [InvoiceController::class, 'placeOrder'])->name('user.placeOrder');
        Route::get('/order/{orderId}/bill', [InvoiceController::class, 'orderBill'])->name('user.orderBill');
        Route::post('/order/confirm', [InvoiceController::class, 'placeOrder'])->name('order.confirm');
    });
    //Route::get('user/orderBill', [OrderController::class, 'checkout'])->name('user.orderBill');
    Route::get('/order/bill/download/{orderId}', [OrderController::class, 'downloadOrderBill'])->name('download.orderBill');
});



require __DIR__ . '/auth.php';
Route::get('admin/dashbord', [AdminController::class, 'index']);
Route::get('/welcome', [HomeController::class, 'welcome']);
Route::get('user/aboutus', [HomeController::class, 'index'])->name('user.aboutus');
Route::get('user/shop', [HomeController::class, 'shop'])->name('user.shop');
// Route::get('user/cart', [HomeController::class, 'cart'])->name('user.cart');
Route::get('user/productDetails/{id}', [ProductController::class, 'show'])->name('user.productDetails.show');
Route::get('user/shop', [ProductController::class, 'showShop'])->name('user.shop');
Route::get('/shop/load-more', [ProductController::class, 'loadMoreProducts']);

Route::get('user/faq', [HomeController::class, 'faq'])->name('user.faq');
// Inside routes/web.php
Route::middleware('auth')->group(function () {
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

Route::middleware(['auth', AuthAdmin::class])->group(function () {
    Route::get('admin/navbar', [AdminController::class, 'navbar'])->name('admin.navbar');
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/brands', [AdminController::class, 'brands'])->name('admin.brands');
    Route::get('admin/add-brand', [AdminController::class, 'addBrand'])->name('admin.add-brand');
    Route::post('admin/add-brand', [AdminController::class, 'saveBrand'])->name('admin.saveBrand');
    // Display the edit form (GET request)
    Route::get('admin/edit-brand/{id}', [AdminController::class, 'editBrand'])->name('admin.editBrand');

    // Handle the form submission and update the brand (POST request)
    Route::put('admin/edit-brand/{id}', [AdminController::class, 'updateBrand'])->name('admin.updateBrand');
    Route::delete('/admin/delete-brand/{id}', [AdminController::class, 'deleteBrand'])->name('admin.deleteBrand');

    Route::get('/admin/categorys', [AdminController::class, 'categories'])->name('admin.categorys');
    Route::get('admin/add-category', [AdminController::class, 'addCategory'])->name('admin.add-category');
    Route::post('admin/add-category', [AdminController::class, 'saveCategory'])->name('admin.saveCategory');
    Route::get('admin/edit-category/{id}', [AdminController::class, 'editCategory'])->name('admin.edit-category');
    Route::put('admin/update-category/{id}', [AdminController::class, 'updateCategory'])->name('admin.updateCategory');
    Route::delete('admin/delete-category/{id}', [AdminController::class, 'deleteCategory'])->name('admin.deleteCategory');

    Route::get('admin/products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('admin/add-product', [ProductController::class, 'showAddProductForm'])->name('admin.add-product');
    Route::post('admin/add-product', [ProductController::class, 'store'])->name('admin.storeProduct');
    Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.editProducts');
    Route::put('/admin/products/{id}/update', [ProductController::class, 'update'])->name('admin.updateProducts');
    // Route::delete('/admin/products/{id}', [ProductController::class, 'delete'])->name('admin.deleteProducts');
    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('admin.deleteProducts');
    // Admin route to view orders
    // Order Routes
    Route::get('/admin/orders', [OrderController::class, 'viewOrders'])->name('admin.order');
    Route::get('/admin/orders/create', [OrderController::class, 'create'])->name('admin.createOrder');
    Route::post('/admin/orders', [OrderController::class, 'store'])->name('admin.storeOrder');
    Route::get('/admin/orders/{order}/edit', [OrderController::class, 'edit'])->name('admin.update-order');
    Route::put('/admin/orders/{order}', [OrderController::class, 'update'])->name('admin.updateOrder');
    Route::delete('/admin/orders/{order}', [OrderController::class, 'destroy'])->name('admin.destroyOrder');
});
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('users', [UserAdminController::class, 'showUsers'])->name('admin.users');
    Route::get('search-users', [UserAdminController::class, 'searchUsers'])->name('admin.search.users');
    Route::get('/user/create', [UserAdminController::class, 'createUser'])->name('add-user');
    Route::post('/user', [UserAdminController::class, 'storeUser'])->name('store-user');
    Route::get('/user/{id}/edit', [UserAdminController::class, 'editUser'])->name('editUser');
    Route::put('/user/{id}', [UserAdminController::class, 'updateUser'])->name('update-user');
    Route::delete('/user/{id}', [UserAdminController::class, 'deleteUser'])->name('deleteUser');
});
Route::resource('reviews', ReviewController::class)->only(['edit', 'update']);
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');


Route::get('/user/policy', [HomeController::class, 'policy'])->name('user.policy');
Route::get('/user/privilege', [HomeController::class, 'privilege'])->name('user.privilege');
Route::get('/search', [HomeController::class, 'searchResults'])->name('usershop');


use App\Http\Controllers\WishlistController;
use App\Models\Payment;

Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('user.wishlist');
    Route::post('/wishlist/add/{product_id}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{product_id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::delete('/wishlist/clear', [WishlistController::class, 'clear'])->name('wishlist.clear');
});
Route::get('/admin/messages', [ContactController::class, 'index'])->name('admin.messages');



// In web.php (routes file)
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
// Route::get('/user/esewa/payment', [PaymentController::class, 'esewaPayment'])->name('user.esewa.payment');
Route::get('/user/invoice', [InvoiceController::class, 'generateInvoice'])->name('user.invoice');


Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');


// Route::post('/place-order', [InvoiceController::class, 'placeOrder'])->name('user.placeOrder');

Route::post('/place-order', [KhaltiController::class, 'placeOrder'])->name('user.placeOrder');
Route::get('/khalti/verify', [KhaltiController::class, 'verifyPayment'])->name('khalti.payment.verify');
Route::get('/khalti/initiate', [KhaltiController::class, 'initiatePayment'])->name('khalti.initiate');
// Route::post('/khalti/callback/{order_id}', [KhaltiController::class, 'handleCallback'])->name('khalti.callback');
Route::match(['get', 'post'], '/khalti/callback/{order_id}', [KhaltiController::class, 'handleCallback'])->name('khalti.callback');
// Route for eSewa (you'll need to create the EsewaController)
// Route::get('/esewa/pay/{orderId}/{totalAmount}', [EsewaController::class, 'pay'])->name('esewa.pay');
Route::get('/order/{orderId}/bill', [InvoiceController::class, 'orderBill'])->name('user.orderBill');

Route::post('/submit-rating', [ProductController::class, 'submitRating'])->name('submit.rating');
Route::get('/admin/ratings', [AdminController::class, 'showRatings'])->name('admin.rating');

Route::get('login/google', [LoginController::class, 'redirectToGoogle']);
Route::get('callback/google', [LoginController::class, 'handleGoogleCallback']);
// Show the reset password form (based on username)
Route::get('reset-password', [PasswordResetLinkController::class, 'create'])->name('forgot-password.form');

// Handle reset password submission (update password directly)
Route::post('reset-password', [PasswordResetLinkController::class, 'store'])->name('password.reset.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/user/settings', [SettingController::class, 'settings'])->name('user.settings');
    Route::delete('/settings/delete-account', [SettingController::class, 'destroy'])->name('user.delete');
});

Route::post('/checkout/esewa/initiate', [EsewaController::class, 'initiatePaymentFromCart'])->name('esewa.initiate');
Route::get('/checkout/esewa/success', [EsewaController::class, 'paymentSuccess'])->name('esewa.success');
Route::get('/checkout/esewa/failure', [EsewaController::class, 'paymentFailure'])->name('esewa.failure');


Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/fetch', [ChatController::class, 'fetchMessages'])->name('chat.fetch');
});
Route::middleware(['auth'])->group(function () {
    // User's chat with admin
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/fetch/{receiverId}', [ChatController::class, 'fetchUserMessages'])->name('chat.fetch'); // User's fetch route
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');

    // Admin chat interface
    Route::get('/admin/chat/{userId}', [ChatController::class, 'adminChat'])->name('admin.chat');
    Route::get('/admin/chat/fetch/{receiverId}', [ChatController::class, 'fetchMessages'])->name('admin.fetch.messages'); // Admin's fetch route
    Route::delete('/admin/chat/delete/{id}', [ChatController::class, 'deleteMessage'])->name('chat.delete');
});


Route::get('/contact', [ContactController::class, 'create'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'store'])->name('contacts.store');

Route::get('user/payment', [HomeController::class, 'payment'])->name('user.payment');

// web.php
Route::get('/user/customerservice', [HomeController::class, 'customerService'])->name('user.customerservice');
