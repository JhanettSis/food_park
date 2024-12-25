<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfilePasswordUpdateRequest;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Traits\FileUploadTrait;
use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class AdminProfileController
 *
 * This controller handles profile management for admin users.
 * It provides functionality to view, update profile information,
 * and change passwords.
 */
class AdminProfileController extends Controller
{
    use FileUploadTrait;  // Use the FileUploadTrait to handle file uploads.

    /**
     * Display the admin profile page.
     *
     * @return View The admin profile view.
     */
    public function index(): View
    {
        // Return the profile view from resources/views/admin/profile/index.blade.php
        return view('admin.profile.index');
    }

    /**
     * Update the admin user's profile information.
     *
     * This method handles updating the admin's name, email, and avatar.
     * If an avatar is uploaded, it replaces the current one.
     *
     * @param ProfileUpdateRequest $request The validated request data for profile update.
     * @return RedirectResponse Redirects back to the profile page with a success message.
     */
    public function updateProfile(ProfileUpdateRequest $request): RedirectResponse
    {
        // Retrieve the currently authenticated user
        $user = Auth::user();

        // Upload the avatar image if present in the request
        $imagePath = $this->uploadImage($request, 'avatar');

        // Update user information with validated request data
        $user->name = $request->name;
        $user->email = $request->email;

        // Update the avatar path if a new image is uploaded, else retain the old one
        $user->avatar = isset($imagePath) ? $imagePath : $user->avatar;

        // Save the updated user information to the database
        $user->save();

        // Display a success message using Toastr
        toastr('Update successfully!', 'success');

        // Redirect back to the profile page
        return redirect()->back();
    }

    /**
     * Update the admin user's password.
     *
     * This method updates the admin's password after validating the input.
     *
     * @param ProfilePasswordUpdateRequest $request The validated request data for password update.
     * @return RedirectResponse Redirects back to the profile page with a success message.
     */
    public function updatePassword(ProfilePasswordUpdateRequest $request): RedirectResponse
    {
        // Retrieve the currently authenticated user
        $user = Auth::user();

        // Hash the new password and update it
        $user->password = bcrypt($request->password);

        // Save the updated password to the database
        $user->save();

        // Display a success message using Toastr
        toastr()->success('Password updated successfully!');

        // Redirect back to the profile page
        return redirect()->back();
    }
}
