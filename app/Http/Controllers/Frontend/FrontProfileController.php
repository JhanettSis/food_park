<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\FrontProfilePasswordUpdateRequest;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use App\Traits\FileUploadTrait;
use Auth;  // Import Auth facade to handle authentication
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FrontProfileController extends Controller
{
    use FileUploadTrait;
    /**
     * Using Auth::user() Instead of Passing User ID
     *  Security: Directly fetching the authenticated user ensures
     *  the user cannot update another user's profile by manipulating form data.
     *  Simplicity: No need to pass the user ID in the form,
     *  reducing the chance of errors or unauthorized access.
     *  Consistency: This approach automatically works across different
     *  controllers and methods without additional configuration.
     *
     * Update the profile information of the authenticated user.
     *
     * @param ProfileUpdateRequest $request - Validated request containing updated profile data.
     * @return RedirectResponse - Redirects back to the previous page after updating the profile.
     */
    function updateProfile(ProfileUpdateRequest $request): RedirectResponse
    {
        // Retrieve the currently authenticated user using the Auth facade
        $user = Auth::user();

        // Update the user's name and email with the data from the form request
        $user->name = $request->name;
        $user->email = $request->email;

        // Save the updated user information to the database
        $user->save();

        // Display a success notification using Toastr (a notification library)
        toastr()->success('Profile Update Successfully!');

        // Redirect back to the profile page or previous page
        return redirect()->back();
    }

    /**
     * Update the password of the authenticated user.
     *
     * @param FrontProfilePasswordUpdateRequest $request - Validated request containing the new password.
     * @return RedirectResponse - Redirects back after updating the password.
     */
    function updatePassword(FrontProfilePasswordUpdateRequest $request): RedirectResponse
    {
        // Retrieve the currently authenticated user
        $user = Auth::user();

        // Hash the new password and assign it to the user object
        $user->password = bcrypt($request->password);

        // Save the updated password to the database
        $user->save();

        // Display a success notification using Toastr
        toastr()->success('Password updated successfully!');

        // Redirect back to the profile page or previous page
        return redirect()->back();
    }

    /**
     * Update the authenticated user's avatar (profile picture).
     *
     * This method handles the avatar upload process, updates the user's avatar path
     * in the database, and returns a success response.
     *
     * @param Request $request - HTTP request containing the uploaded avatar file.
     * @return \Illuminate\Http\JsonResponse - Returns a JSON response indicating success.
     */
    function updateAvatar(Request $request)
    {
        // Retrieve the currently authenticated user using the Auth facade.
        $user = Auth::user();

        // Upload the image using the uploadImage method (likely part of a trait or helper).
        // 'avatar' is the name of the input field in the form.

        /** Handle Image Upload */
        /**
         * the function uploadImage(); is on file
         * App/Trails/FileUploadTrait.php
         *  */
        if ($request->hasFile('avatar')) {
            if ($user->avatar != '/uploads/user_default.png') {

                $imagePath = $this->uploadImage($request, 'avatar', '/avatarImages', $user->avatar);
            } else {
                $imagePath = $this->uploadImage($request, 'avatar', '/avatarImages');
            }
                // Set the user's avatar field to the newly uploaded image path.
            $user->avatar = $imagePath;
        }
        // Save the updated user record in the database.
        $user->save();

        // Return a JSON response to the client indicating the update was successful.
        return response([
            'status' => 'success',                      // Status of the operation.
            'message' => 'Avatar Updated Successfully!' // Success message for feedback.
        ]);
    }
}
