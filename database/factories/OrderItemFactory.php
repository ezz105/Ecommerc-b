<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
            'artisan_id' => User::where('role_id', 3)->inRandomOrder()->first()->id,  // Random artisan user
            'quantity' => $this->faker->numberBetween(1, 5),  // Random quantity between 1 and 5
            'price_per_unit' => $this->faker->randomFloat(2, 10, 100),
            'total_price' => function (array $attributes) {
                return $attributes['quantity'] * $attributes['price_per_unit'];
            },
            'status' => $this->faker->randomElement(['pending', 'processing', 'shipped', 'delivered', 'cancelled']),
        ];
    }
}
