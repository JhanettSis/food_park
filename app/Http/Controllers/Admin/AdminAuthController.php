<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

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

    /**
     * Show the admin forget password form.
     *
     * @return \Illuminate\View\View
     */
    public function forgetPassword()
    {
        return view('admin.auth.forgot_password');
    }

    /**
     * Handle the forget password request and send reset link.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLink(Request $request)
    {
        // Validate the email input
        $request->validate([
            'email' => 'required|email',
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );
        // Check the response and show appropriate message
        toastr('Reset link sent in to your email', 'success');
        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }

}
