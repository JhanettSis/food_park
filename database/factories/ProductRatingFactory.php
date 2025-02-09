<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductRating;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductRating>
 */
class ProductRatingFactory extends Factory
{
    protected $model = ProductRating::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'user_id' => User::inRandomOrder()->first()->id,  // Random user from the users table
            'product_id' => Product::inRandomOrder()->first()->id,  // Random product from the products table
            'rating' => $this->faker->numberBetween(1, 5),  // Random rating between 1 and 5
            'review' => $this->faker->text(200),  // Random review text
            'status' => $this->faker->boolean(),  // Random boolean for status
        ];
    }
}
