<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\FrontProfileController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

// ==============================
// ROUTES DEFINITION FOR WEB APPLICATION
// ==============================

// The commented-out route below was the default Laravel welcome page.
// It was replaced by a custom home route.
// Route::get('/', function () {
//     return view('welcome');
// });

/**
 * Homepage route
 *
 * - This route is for the main frontend home page.
 * - It maps the root URL ('/') to the 'index' method of the FrontendController.
 * - The route is named 'home' for easy referencing throughout the application.
 */
Route::get('/', [FrontendController::class, 'index'])->name('home');
/**
 * THis route is for detail product page
 */
Route::get('/product/{slug}', [FrontendController::class, 'showProduct'])->name('product.show');

/** Product Modal route */
Route::get('/loadProductModal/{productId}', [FrontendController::class, 'loadProductModal'])->name('loadProductModal');

/** Add to cart Product Modal route */
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');

Route::get('/getCartProducts', [CartController::class, 'getCartProduct'])->name('get-cart-products');
Route::get('/cart-product-remove/{rowId}', [CartController::class, 'cart_product_remove'])->name('cartProductRemove');

/** Cart Page Routes */
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/car-update-qty', [CartController::class, 'cart_qty_update'])->name('carUpdate.qty');
Route::get('/cart-destroy', [CartController::class, 'cart_destroye'])->name('cart.destroye');
Route::post('/apply-coupon', [CartController::class, 'applyCoupon'])->name('applyCoupon');
Route::get('/destroye-coupon', [CartController::class, 'destroyeCoupon'])->name('destroye.coupon');
Route::group(['middleware' => 'auth'], function(){
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/checkout/{id}/delivery-calculation', [CheckoutController::class, 'CalculateDeliveryCharge'])->name('checkout.delivery-calculation');
    Route::post('/checkout', [CheckoutController::class, 'checkoutRedirect'])->name('checkout.redirect');
    /** Payment Routes */
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/make-payment', [PaymentController::class, 'makePayment'])->name('make-payment');

    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('payment-cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');

    /** PayPal Routes */
    Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
    Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');

    /** Stripe Routes */
    Route::get('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');
    Route::get('stripe/success', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
    Route::get('stripe/cancel', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');

});

/**
 * Admin Login Route
 *
 * - This route handles the admin login page.
 * - It maps 'admin/login' to the 'index' method of AdminAuthController.
 * - The route is named 'admin.login'.
 */
Route::group(['middleware' => 'guest'], function(){
    Route::get('admin/login', [AdminAuthController::class, 'index'])->name('admin.login');
    Route::get('admin/forget_password', [AdminAuthController::class, 'forgetPassword'])->name('admin.forget_password');
    Route::post('admin/forget_password', [AdminAuthController::class, 'sendResetLink'])->name('admin.send_reset_link');
});


// ===========================================
// DASHBOARD ROUTES - USER FRONTEND
// ===========================================

// This was the old route for the dashboard, which displayed a static view.
// It was replaced by a new dynamic route that loads content from a controller.
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


/**
 * Authenticated User Dashboard Routes
 *
 * - The following routes are protected by the 'auth' middleware.
 * - Only authenticated users can access these routes.
 *
 * Grouped routes include:
 *  1. Dashboard - Maps to the DashboardController.
 *  2. Profile Update - Updates user's profile information.
 *  3. Password Update - Handles password changes.
 *  4. Avatar Update - Uploads and updates the user's avatar.
 */
Route::group(['middleware' => 'auth'], function() {
    // Dashboard route for authenticated users
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Update profile information (PUT request)
    Route::put('profile', [FrontProfileController::class, 'updateProfile'])->name('profile.update');

    // Update password (PUT request)
    Route::put('profile/password', [FrontProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Upload avatar (POST request)
    Route::post('profile/avatar', [FrontProfileController::class, 'updateAvatar'])->name('profile.avatar.update');

    //
    Route::post('/address', [DashboardController::class, 'createAddress'])->name('address.store');
    Route::put('/address/{id}/edit', [DashboardController::class, 'updateAddress'])->name('address.update');
    Route::delete('/address/{id}', [DashboardController::class, 'destroyAddress'])->name('address.destroy');
});


// ===========================================
// OLD PROFILE ROUTES (COMMENTED OUT)
// ===========================================

// These routes were previously used for profile management but are no longer active.
// They were replaced by the new routes in the section above.
// The new profile update is managed by FrontProfileController.

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// ===========================================
// INCLUDE AUTHENTICATION ROUTES
// ===========================================

// This line imports the default authentication routes provided by Laravel (login, registration, etc.).
require __DIR__.'/auth.php';


// ===========================================
// ADMIN ROUTES (COMMENTED OUT)
// ===========================================

// These routes were originally used to manage the admin dashboard.
// However, they are now moved to a dedicated file 'routes/admin.php'.
// The admin dashboard is protected by the 'auth' middleware and the 'role' middleware,
// ensuring that only users with the 'admin' role can access the admin panel.

// Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])
//     ->middleware(['auth', 'role:admin'])  // Protect the route with 'auth' and 'role:admin'
//     ->name('admin/dashboard');

