<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class FrontProfilePasswordUpdateRequest
 *
 * This FormRequest handles the validation logic for updating the password
 * of frontend users. It ensures that the current password is correctly verified
 * and the new password meets the required criteria.
 */
class FrontProfilePasswordUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * This method checks if the user has permission to perform this action.
     * By default, it returns true, allowing any authenticated user to proceed.
     *
     * @return bool Returns true to authorize the request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * This method defines the validation rules for updating the password.
     * - `current_password` must match the user's existing password.
     * - `password` must be required, have at least 5 characters, and match
     *    the password confirmation field.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     * An array of validation rules that the request must meet.
     */
    public function rules(): array
    {
        return [
            // Validate that the current password is required and matches the existing password
            'current_password' => ['required', 'current_password'],

            // Validate that the new password is required, has a minimum of 5 characters,
            // and matches the 'password_confirmation' field
            'password' => ['required', 'min:5', 'confirmed'],
        ];
    }

    /**
     * Customize error messages for validation failures.
     *
     * This method allows you to define custom error messages for specific
     * validation rules. In this case:
     * - If the current password does not match, display a custom error message.
     *
     * @return array<string, string> An array of custom error messages.
     */
    public function messages(): array
    {
        return [
            // Custom message when the current password validation fails
            'current_password.current_password' => 'Current password is invalid',
        ];
    }
}
