<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    protected static function newFactory() {
        return \Database\Factories\SizeProductFactory::new();
    }
    protected $table = 'size_product';

}
