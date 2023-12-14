<?php

namespace Database\Factories\Backend;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Backend\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['movie', 'serie', 'game']);
        $faker = Faker::create();
        return [
            'code' => random_int(1000000000,9999999999),
            "title" => $this->faker->sentence(),
            "description" => $this->faker->paragraph(),
            "short_descp" => $this->faker->paragraph(),
            "release_date" => rand(1994, 2023),
            "runtime" => '2h',
            "video_format" => '720p',
            "rating" => rand(1, 10),
            "trailer" => 'https://www.youtube.com/watch?v=VyHV0BRtdxo',
            "selling_price" => '100',
            "discount_price" => '100',
            "user_id" => rand(1, 10),
            'status' => $this->faker->randomElement([1, 0]),
            'type' => $type,
        ];
    }
}
