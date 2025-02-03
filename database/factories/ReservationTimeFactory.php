<?php

namespace Database\Factories;

use App\Models\ReservationTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReservationTime>
 */
class ReservationTimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ReservationTime::class;

    public function definition(): array
    {
        return [
            'start_time' => $this->faker->time('H:i'),
            'end_time' => $this->faker->time('H:i'),
            'status' => $this->faker->boolean(90), // 90% chance it's active (1)
        ];
    }
}
