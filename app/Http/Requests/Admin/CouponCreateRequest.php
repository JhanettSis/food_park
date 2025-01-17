<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CouponCreateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:100|unique:coupons,code',
            'quantity' => 'required|integer|min:1',
            'min_purchase_amount' => 'required|integer|min:0',
            'expire_date' => 'required|date|after:today',
            'discount_type' => 'required',
            'discount' => 'required|numeric|min:1',
            'status' => 'required|boolean',
        ];
    }
}
