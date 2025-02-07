<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use App\Models\Category;
use App\Models\User;
use Auth;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Testing\Fakes\Fake;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' =>  function(){
                    return User::inRandomOrder()->first()->id;
                },
            'category_id' => function() {
                    return BlogCategory::inRandomOrder()->first()->id;
                },
            'image' => '/uploads/imageDefault.jpg',
            'title' => $this->faker->paragraph(2),
            'slug' => Str::slug($this->faker->sentence(3)),
            'description' => $this->faker->paragraph(5),
            'seo_title' => fake()->sentence(2),
            'seo_description' => fake()->paragraph(3),
            'status' => $this->faker->boolean(),
        ];
    }
}
