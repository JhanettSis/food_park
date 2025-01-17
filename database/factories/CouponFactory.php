<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(2), // Generates a random name like "Super Sale"
            'code' => strtoupper(fake()->lexify('??????')), // Generates a 6-character code like 'ABC123'
            'quantity' => fake()->numberBetween(50, 1000), // Random quantity between 50 and 1000
            'min_purchase_amount' => fake()->numberBetween(1, 30), // Random min purchase between 1 and 30
            'expire_date' => fake()->dateTimeBetween('now', '+1 year'), // Random expire date within a year from today
            'discount_type' => fake()->randomElement(['percentage', 'amount']), // Random discount type
            'discount' => fake()->numberBetween(5, 50), // Random discount between 5 and 50 (either percentage or flat)
            'status' => fake()->boolean(), // Random boolean value (true or false)
        ];
    }
}
