<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogComment>
 */
class BlogCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'blog_id' => function() {
                    return Blog::inRandomOrder()->first()->id;
                },
            'user_id' => function(){
                return User::inRandomOrder()->first()->id;
            },
            'comment' => $this->faker->paragraph(5),
            'status' => $this->faker->boolean(),

        ];
    }
}
