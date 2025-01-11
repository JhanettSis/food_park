<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\FrontProfileController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\CartController;
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

