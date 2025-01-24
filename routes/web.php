<?php

// Importing necessary controllers for different parts of the application
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

/**
 * Homepage Route
 *
 * - This route handles the main frontend homepage.
 * - It maps the root URL ('/') to the 'index' method of the FrontendController.
 * - The route is named 'home' for easy referencing.
 */
Route::get('/', [FrontendController::class, 'index'])->name('home');

/**
 * Product Detail Route
 *
 * - This route shows the details of a specific product.
 * - It uses a 'slug' parameter to uniquely identify the product.
 * - It maps the route to the 'showProduct' method of the FrontendController.
 */
Route::get('/product/{slug}', [FrontendController::class, 'showProduct'])->name('product.show');

/**
 * Product Modal Route
 *
 * - This route is for loading the product modal.
 * - It takes a 'productId' parameter to fetch the product data.
 */
Route::get('/loadProductModal/{productId}', [FrontendController::class, 'loadProductModal'])->name('loadProductModal');

/**
 * Add to Cart Route
 *
 * - This route handles adding a product to the shopping cart.
 * - It is a POST request to the 'addToCart' method in CartController.
 */
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');

/**
 * Get Cart Products Route
 *
 * - This route retrieves the products in the cart.
 * - It maps to the 'getCartProduct' method of the CartController.
 */
Route::get('/getCartProducts', [CartController::class, 'getCartProduct'])->name('get-cart-products');

/**
 * Remove Cart Product Route
 *
 * - This route removes a product from the cart.
 * - It takes a 'rowId' parameter to identify the product to remove.
 */
Route::get('/cart-product-remove/{rowId}', [CartController::class, 'cart_product_remove'])->name('cartProductRemove');

/** Cart Page Routes */

/**
 * Cart Page Route
 *
 * - This route displays the shopping cart page.
 * - It maps to the 'index' method of CartController.
 */
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

/**
 * Cart Quantity Update Route
 *
 * - This route allows updating the quantity of products in the cart.
 * - It maps to the 'cart_qty_update' method of CartController.
 */
Route::post('/car-update-qty', [CartController::class, 'cart_qty_update'])->name('carUpdate.qty');

/**
 * Cart Destroy Route
 *
 * - This route clears all products in the cart.
 * - It maps to the 'cart_destroye' method of CartController.
 */
Route::get('/cart-destroy', [CartController::class, 'cart_destroye'])->name('cart.destroye');

/**
 * Apply Coupon Route
 *
 * - This route allows applying a coupon code for a discount.
 * - It maps to the 'applyCoupon' method of CartController.
 */
Route::post('/apply-coupon', [CartController::class, 'applyCoupon'])->name('applyCoupon');

/**
 * Destroy Coupon Route
 *
 * - This route allows removing the applied coupon from the cart.
 * - It maps to the 'destroyeCoupon' method of CartController.
 */
Route::get('/destroye-coupon', [CartController::class, 'destroyeCoupon'])->name('destroye.coupon');

/** Authentication Routes - Protecting Checkout & Payment Routes */
Route::group(['middleware' => 'auth'], function(){

    /**
     * Checkout Route
     *
     * - This route is for the checkout page.
     * - It maps to the 'index' method of CheckoutController.
     */
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

    /**
     * Delivery Charge Calculation Route
     *
     * - This route calculates delivery charges during checkout.
     * - It maps to the 'CalculateDeliveryCharge' method of CheckoutController.
     */
    Route::get('/checkout/{id}/delivery-calculation', [CheckoutController::class, 'CalculateDeliveryCharge'])->name('checkout.delivery-calculation');

    /**
     * Checkout Redirection Route
     *
     * - This route handles the redirection after completing checkout.
     * - It maps to the 'checkoutRedirect' method of CheckoutController.
     */
    Route::post('/checkout', [CheckoutController::class, 'checkoutRedirect'])->name('checkout.redirect');

    /** Payment Routes */
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/make-payment', [PaymentController::class, 'makePayment'])->name('make-payment');

    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('payment-cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');

    /** PayPal Payment Routes */
    Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
    Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');

    /** Stripe Payment Routes */
    Route::get('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');
    Route::get('stripe/success', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
    Route::get('stripe/cancel', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');

    /** Razorpay Payment Routes */
    Route::get('razorpay-redirect', [PaymentController::class, 'razorpayRedirect'])->name('razorpay-redirect');
    Route::post('razorpay/payment', [PaymentController::class, 'payWithRazorpay'])->name('razorpay.payment');

});

/**
 * Admin Login Routes
 *
 * - These routes handle the login functionality for the admin panel.
 * - They are protected by the 'guest' middleware, allowing access only for unauthenticated users.
 */
Route::group(['middleware' => 'guest'], function(){
    Route::get('admin/login', [AdminAuthController::class, 'index'])->name('admin.login');
    Route::get('admin/forget_password', [AdminAuthController::class, 'forgetPassword'])->name('admin.forget_password');
    Route::post('admin/forget_password', [AdminAuthController::class, 'sendResetLink'])->name('admin.send_reset_link');
});

// ===========================================
// DASHBOARD ROUTES - USER FRONTEND
// ===========================================

/**
 * User Dashboard Routes
 *
 * - These routes are protected by the 'auth' middleware.
 * - Only authenticated users can access their dashboard, profile, and related routes.
 */
Route::group(['middleware' => 'auth'], function() {

    /**
     * Dashboard Route
     *
     * - This route shows the user's dashboard after they log in.
     * - It maps to the 'index' method of DashboardController.
     */
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /**
     * Profile Update Route
     *
     * - This route allows the user to update their profile information.
     * - It maps to the 'updateProfile' method of FrontProfileController.
     */
    Route::put('profile', [FrontProfileController::class, 'updateProfile'])->name('profile.update');

    /**
     * Password Update Route
     *
     * - This route allows the user to change their password.
     * - It maps to the 'updatePassword' method of FrontProfileController.
     */
    Route::put('profile/password', [FrontProfileController::class, 'updatePassword'])->name('profile.password.update');

    /**
     * Avatar Upload Route
     *
     * - This route allows the user to upload a new avatar image.
     * - It maps to the 'updateAvatar' method of FrontProfileController.
     */
    Route::post('profile/avatar', [FrontProfileController::class, 'updateAvatar'])->name('profile.avatar.update');

    /**
     * User Address Routes
     *
     * - These routes allow users to create, update, and delete their addresses.
     */
    Route::post('/address', [DashboardController::class, 'createAddress'])->name('address.store');
    Route::put('/address/{id}/edit', [DashboardController::class, 'updateAddress'])->name('address.update');
    Route::delete('/address/{id}', [DashboardController::class, 'destroyAddress'])->name('address.destroy');
});

// ===========================================
// OLD PROFILE ROUTES (COMMENTED OUT)
// ===========================================

// These routes were previously used for profile management but are no longer active.
// They were replaced by the new routes in the section above.

// ===========================================
// INCLUDE AUTHENTICATION ROUTES
// ===========================================

// Including Laravel's default authentication routes (e.g., login, registration)
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

