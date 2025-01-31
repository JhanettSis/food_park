<?php

namespace Database\Factories;

use App\Models\Chef;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chef>
 */
class ChefFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Chef::class;

    public function definition(): array
    {
        return [
            'image' => '/uploads/imageDefault.jpg',
            'name' => $this->faker->name(),
            'title' => $this->faker->word(),
            'fb' => $this->faker->url(),
            'in' => $this->faker->url(),
            'x' => $this->faker->url(),
            'web' => $this->faker->url(),
            'show_at_home' => $this->faker->boolean(),
            'status' => $this->faker->boolean(),
        ];
    }
}
