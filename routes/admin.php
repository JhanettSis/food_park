<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('admin/dashboard', [AdminDashboardController ::class, 'index'])
//     ->middleware(['auth', 'role:admin'])  // Ensure you use 'role' middleware with the 'admin' role
//     ->name('admin/dashboard');
Route::group(['prefix' => 'admin'], function(){
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});









