<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderItem;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'product_id' => Product::inRandomOrder()->first()->id,
            'order_item_id' => OrderItem::inRandomOrder()->first()->id,
            'rating' => $this->faker->numberBetween(1, 5),
            'title' => $this->faker->sentence,
            'comment' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
