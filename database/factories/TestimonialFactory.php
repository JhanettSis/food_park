<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimonial>
 */
class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => '/uploads/imageDefault.jpg',
            'name' => $this->faker->name,  // Random name
            'title' => $this->faker->jobTitle,  // Random title (e.g., "CEO", "Manager")
            'review' => $this->faker->paragraph,  // Random review text
            'rating' => $this->faker->numberBetween(1, 5),  // Random rating between 1 and 5
            'show_at_home' => $this->faker->boolean,  // Random boolean for whether to show at home
            'status' => $this->faker->boolean,  // Random boolean for the status (active or not)
        ];
    }
}
