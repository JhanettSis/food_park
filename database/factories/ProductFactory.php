<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $offer_price = fake()->randomFloat(2, 10, 100);
        $price = fake()->randomFloat(2, max($offer_price + 0.01, 10), 100);

        return [
            'product_name' => fake()->word(3),
            'slug' => Str::slug($this->faker->sentence(3), '-'), // Generates a slug
            'product_image' => '/uploads/imageDefault.jpg',
            'category_id' => function(){
                return Category::inRandomOrder()->first()->id;
            },
            'short_description' => fake()->paragraph(3),
            'long_description' => fake()->paragraph(5),
            'price' => $price,
            'offer_price' => $offer_price,
            // 'price' => fake()->randomFloat(2, 10, 100),
            // 'offer_price' => fake()->randomFloat(2, 10, 100),
            'quantity' => fake()->numberBetween(3, 100),
            'sku' => fake()->unique()->ean13(),
            'seo_title' => fake()->sentence(2),
            'seo_description' => fake()->paragraph(3),
            'show_at_home' => fake()->boolean(),
            'status' => fake()->boolean()
        ];
    }
}
