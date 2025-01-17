<?php
/**
 * For register the new file called admin.php
 * this is for admin route's and separate the routes for normal user and admin
 * I add this file admin.php(routes for admin) on botstrap/app.php file this is new in laravel 11
 */
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OptionProductController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\ProductSizeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use Illuminate\Support\Facades\Route;

// Route Grouping:

// prefix => 'admin' ensures all routes have /admin in the URL.
// as => 'admin' prefixes route names with admin. (e.g., admin.dashboard).
// Dashboard Route:

// A GET request to /admin/dashboard calls the index method of AdminDashboardController.
// Named admin.dashboard for easy reference.
// Profile Routes:

// A GET request to /admin/profile shows the profile page.
// A PUT request to /admin/profile updates profile details.
// A PUT request to /admin/profile/password handles password updates.
// Route::get('admin/dashboard', [AdminDashboardController ::class, 'index'])
//     ->middleware(['auth', 'role:admin'])  // Ensure you use 'role' middleware with the 'admin' role
//     ->name('admin/dashboard');

// Admin Routes Group - Organizes all admin-related routes under the 'admin' prefix and name

// Group routes with a prefix of 'admin' and named as 'admin' (e.g., admin.dashboard, admin.profile)
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    /**
     * Admin Dashboard Route
     * URL: /admin/dashboard
     * Controller: AdminDashboardController
     * Method: index
     * Name: admin.dashboard
     *
     * This route displays the admin dashboard.
     */
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    /**
     * Admin Profile View Route
     * URL: /admin/profile
     * Controller: AdminProfileController
     * Method: index
     * Name: admin.profile
     *
     * Displays the admin's profile page where profile details can be viewed or edited.
     */
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');

    /**
     * Admin Profile Update Route
     * URL: /admin/profile (PUT)
     * Controller: AdminProfileController
     * Method: updateProfile
     * Name: admin.profile.update
     *
     * Handles profile update requests (e.g., name, email).
     */
    Route::put('/profile', [AdminProfileController::class, 'updateProfile'])->name('profile.update');

    /**
     * Admin Password Update Route
     * URL: /admin/profile/password (PUT)
     * Controller: AdminProfileController
     * Method: updatePassword
     * Name: admin.profile.password.update
     *
     * Handles requests to update the admin's password.
     */
    Route::put('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password.update');

    /** Silder route */
    Route::resource('/slider', SliderController::class);

    /** WhyChooseUs section route */
    Route::put('/why_choose_title_update', [WhyChooseUsController::class, 'updateTitle'])->name('why_choose_title.update');
    Route::resource('/why_choose_us', WhyChooseUsController::class);

    /** Route Product Category */
    Route::resource('/categories', CategoryController::class);

    /** Route Product */
    Route::resource('/products', ProductController ::class);

    /** Route Product Gallery */
    Route::get('/product-gallery/{product}', [ProductGalleryController ::class, 'index'])->name('product-gallery.show-index');
    Route::resource('/product-gallery', ProductGalleryController ::class);

    /** Route Product Size */
    Route::get('/product-size/{product}', [ProductSizeController ::class, 'index'])->name('product-size.show-index');
    Route::resource('/product-size', ProductSizeController ::class);

    /** Route Product Size */
    Route::resource('/product-option', OptionProductController::class);

    /** Setting routes */
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::put('/general-setting', [SettingController::class, 'UpdateGeneralSetting'])->name('general_setting.update');

    /** Coupon Routes  */
    Route::resource('/coupons', CouponController::class);

});
