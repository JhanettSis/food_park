<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\About>
 */
class AboutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => '/uploads/imageDefault.jpg',
            'title' => $this->faker->sentence(),
            'main_title' => $this->faker->sentence(),
            'description' => $this->faker->sentence(3),
            'video_link' => '',
        ];
    }
}
