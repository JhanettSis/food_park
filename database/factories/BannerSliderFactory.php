<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BannerSlider>
 */
class BannerSliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'sub_title' => $this->faker->sentence,
            'url' => $this->faker->url,
            'banner' => '/uploads/imageDefault.jpg',
            'status' => $this->faker->boolean,
        ];
    }
}
