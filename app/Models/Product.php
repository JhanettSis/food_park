<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PhpParser\Node\Stmt\Return_;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
            'product_name' ,
            'slug',
            'product_image',
            'category_id',
            'short_description',
            'long_description',
            'price',
            'offer_price',
            'quantity',
            'sku',
            'seo_title',
            'seo_description',
            'show_at_home',
            'status'
    ];

    function category() : BelongsTo {
        return $this->belongsTo(Category::class);
    }

    function galleryProduct() : HasMany {
        return $this->hasMany(ProductGallery::class);
    }

    function sizeProduct() : HasMany {
        return $this->hasMany(ProductSize::class);
    }

    function optionProduct() : HasMany {
        return $this->hasMany(OptionProduct::class);
    }

    function reviews() : HasMany {
        return $this->hasMany(ProductRating::class, 'product_id', 'id')->where('status', true);
    }

    public function relatedProducts()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id')->where('id', '!=', $this->id);
    }
    function getAverageRating() {
        $total_start_rating = 0;
        $reviews = $this->reviews;
        foreach($reviews as $review) {
            $total_start_rating += $review->rating;
        }
        return $reviews->count() > 0 ? ($total_start_rating / $reviews->count()) : 0;
    }

}
