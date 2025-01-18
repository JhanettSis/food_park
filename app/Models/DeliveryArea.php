<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryArea extends Model
{
    use HasFactory;
    protected $table = 'delivery_areas';

    protected $fillable = [
        'area_name',
        'min_delivery_time',
        'max_delivery_time',
        'delivery_fee',
        'status'
    ];
}
