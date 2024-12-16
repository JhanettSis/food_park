<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('admin_dashboard', [AdminDashboardController ::class, 'index'])
//     ->middleware(['auth', 'role:admin'])  // Ensure you use 'role' middleware with the 'admin' role
//     ->name('admin_dashboard');
Route::group(['prefix' => 'admin'], function(){
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('/');
});









