<?php

namespace Database\Factories;

use App\Models\WhyChooseUs;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WhyChooseUs>
 */
class WhyChooseUsFactory extends Factory
{

    protected $model = WhyChooseUs::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'icon' => $this->faker->randomElement([
                'fas fa-house',
                'fas fa-image',
                'fas fa-star',
                'fas fa-paperclip',
                'fas fa-anchor',
                'fas fa-bicycle',
                'fas fa-bomb',
                'fas fa-car'
            ]),
            'title' => fake()->sentence(),
            'short_description' => fake()->sentence(),
            'status' => fake()->boolean()

        ];
    }
}
