<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SizeProductFactory extends Factory
{
    protected $model = ProductSize::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //'size_name' => $this->faker->randomElement(['Small', 'Medium', 'Large']),
            'size_name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 5, 20),
            'product_id' => Product::all()->random()->id,
        ];
    }
}
