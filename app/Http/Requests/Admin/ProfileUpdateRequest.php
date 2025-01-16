<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'avatar' => 'nullable|image|max:3000',  // The 'avatar' field can be null, but if provided, it must be an image and its size must not exceed 3000 KB (3 MB).
            'name' => ['required', 'string', 'max:200'],  // The 'name' field is required, must be a string, and cannot exceed 200 characters.
            'email' => [
                'required',  // The 'email' field is required.
                'string',    // It must be a string.
                'lowercase', // All characters must be in lowercase.
                'email',     // The input must be a valid email format.
                'max:255',   // It must not exceed 255 characters.
                Rule::unique(User::class)->ignore($this->user()->id), // The email must be unique in the 'users' table, except for the current user's email.
            ],
        ];
    }
}
