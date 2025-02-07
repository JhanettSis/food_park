<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductGallery>
 */
class ProductGalleryFactory extends Factory
{
    protected $model = ProductGallery::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [
        //     'product_id' => Product::all()->random()->id,
        //     'gallery_image' => '/uploads/imageDefault.jpg',
        // ];


        return [
            'product_id' => Product::all()->random()->id,
            'gallery_image' => collect([
                '/uploads/imageDefault.jpg',
                '/uploads/productImages/media_1.jpg',
                '/uploads/productImages/media_2.jpg',
                '/uploads/productImages/media_3.jpg',
                '/uploads/productImages/media_4.jpg',
                '/uploads/productImages/media_5.jpg',
                '/uploads/productImages/media_6.jpg',
                '/uploads/productImages/media_7.jpg',
                '/uploads/productImages/media_8.jpg',
            ])->random(), // Randomly pick an image from the list
        ];
    }
}
