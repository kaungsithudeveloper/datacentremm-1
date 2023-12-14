<?php

namespace Database\Factories\Backend;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Backend\Blog;
use App\Models\Backend\PostTags;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Backend\Blog>
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
            "title" => $this->faker->sentence(),
            "description" => $this->faker->paragraph(),
            "user_id" => rand(1,3),
            'status' => fake()->randomElement(['1','0']),
        ];
    }
}
