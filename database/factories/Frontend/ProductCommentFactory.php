<?php

namespace Database\Factories\Frontend;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Frontend\ProductComment>
 */
class ProductCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "content" => $this->faker->paragraph(),
            "product_id" => rand(1, 50),
            "user_id" => rand(1, 10),
        ];
    }
}
