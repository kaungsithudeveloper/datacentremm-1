<?php

namespace Database\Factories\Backend;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Backend\Movie;
use App\Models\Backend\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MovieFactory extends Factory
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
            "short_descp" => $this->faker->paragraph(),
            "release_date" => rand(1994,2023),
            "runtime" => '2h',
            "video_format" => '720p',
            "rating" => rand(1,10),
            "trailer" => 'https://www.youtube.com/watch?v=VyHV0BRtdxo',
            "selling_price" => '100',
            "discount_price" => '100',
            "user_id" => rand(1,10),
            'status' => fake()->randomElement(['1','0']),


        ];

    }

}
