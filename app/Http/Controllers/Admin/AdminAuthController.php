<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * Class AdminAuthController
 *
 * Handles authentication-related views and logic for the admin panel.
 */
class AdminAuthController extends Controller
{
    /**
     * Display the admin login page.
     *
     * URL: /admin/login
     * Method: GET
     *
     * @return View
     *
     * This method returns the login view for the admin panel.
     * The view is located at 'resources/views/admin/auth/login.blade.php'.
     */
    public function index() : View {
        return view('admin.auth.login');
    }
}
