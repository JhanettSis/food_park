<?php

namespace Database\Factories;

use App\Models\OptionProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OptionProduct>
 */
class OptionProductFactory extends Factory
{
    protected $model = OptionProduct::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'option_name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 1, 20),
            'product_id' => Product::all()->random()->id,
        ];
    }
}
