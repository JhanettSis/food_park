<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SocialLink>
 */
class SocialLinkFactory extends Factory
{
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
            ]),         // Random icon name
            'name' => $this->faker->sentence(3),           // Random name like 'Facebook', 'Twitter'
            'link' => $this->faker->url,            // Random URL
            'status' => $this->faker->boolean(),    // Random true or false
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
