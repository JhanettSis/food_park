<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Counter>
 */
class CounterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $icons = [
            'fas fa-user',
            'fas fa-camera',
            'fas fa-heart',
            'fas fa-cogs',
            'fas fa-globe',
            'fas fa-bell',
            'fas fa-star',
            'fas fa-phone',
            'fas fa-certificate',
            'fas fa-check',
            'fas fa-music',
            'fas fa-paint-brush',
            'fas fa-briefcase',
            'fas fa-shopping-cart',
            'fas fa-wrench',
            'fas fa-lightbulb',
            'fas fa-trophy',
            'fas fa-cloud',
            'fas fa-calendar',
            'fas fa-map-marker',
        ];
        return [
            'background' => '/uploads/imageDefault.jpg',  // Generate a fake background image URL
            'counter_icon_one' => $this->faker->randomElement($icons),  // Random FontAwesome icon for counter 1
            'counter_count_one' => $this->faker->randomNumber(3),  // Random number for counter 1
            'counter_name_one' => $this->faker->sentence(2),  // Random name for counter 1

            'counter_icon_two' => $this->faker->randomElement($icons),  // Random FontAwesome icon for counter 2
            'counter_count_two' => $this->faker->randomNumber(3),  // Random number for counter 2
            'counter_name_two' => $this->faker->sentence(2),  // Random name for counter 2

            'counter_icon_three' => $this->faker->randomElement($icons),  // Random FontAwesome icon for counter 3
            'counter_count_three' => $this->faker->randomNumber(3),  // Random number for counter 3
            'counter_name_three' => $this->faker->sentence(2),  // Random name for counter 3

            'counter_icon_four' => $this->faker->randomElement($icons),  // Random FontAwesome icon for counter 4
            'counter_count_four' => $this->faker->randomNumber(3),  // Random number for counter 4
            'counter_name_four' => $this->faker->sentence(2),  // Random name for counter 4
        ];
    }
}
