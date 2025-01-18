<?php

namespace Database\Factories;

use App\Models\DeliveryArea;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryArea>
 */
class DeliveryAreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'area_name' => fake()->city(), 
            'min_delivery_time' => fake()->numberBetween(10, 30) . ' minutes',
            'max_delivery_time' => fake()->numberBetween(30, 60) . ' minutes',
            'delivery_fee' => fake()->randomFloat(2, 5, 20),
            'status' => fake()->boolean(80),
        ];
    }
}
