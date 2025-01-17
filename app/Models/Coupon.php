<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    /** @use HasFactory<\Database\Factories\CouponFactory> */
    use HasFactory;

    // Define the fillable fields to allow mass assignment
    protected $fillable = [
        'name',
        'code',
        'quantity',
        'min_purchase_amount',
        'expire_date',
        'discount_type',
        'discount',
        'status',
    ];
}
