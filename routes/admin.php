<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProfileController;
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
Route::group(['prefix' => 'admin', 'as' => 'admin'], function(){

    /**
     * Admin Dashboard Route
     * URL: /admin/dashboard
     * Controller: AdminDashboardController
     * Method: index
     * Name: admin.dashboard
     *
     * This route displays the admin dashboard.
     */
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('.dashboard');

    /**
     * Admin Profile View Route
     * URL: /admin/profile
     * Controller: AdminProfileController
     * Method: index
     * Name: admin.profile
     *
     * Displays the admin's profile page where profile details can be viewed or edited.
     */
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('.profile');

    /**
     * Admin Profile Update Route
     * URL: /admin/profile (PUT)
     * Controller: AdminProfileController
     * Method: updateProfile
     * Name: admin.profile.update
     *
     * Handles profile update requests (e.g., name, email).
     */
    Route::put('/profile', [AdminProfileController::class, 'updateProfile'])->name('.profile.update');

    /**
     * Admin Password Update Route
     * URL: /admin/profile/password (PUT)
     * Controller: AdminProfileController
     * Method: updatePassword
     * Name: admin.profile.password.update
     *
     * Handles requests to update the admin's password.
     */
    Route::put('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('.profile.password.update');

});









