<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Cart;
use App\Models\Product;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cart_id' => Cart::factory(),  // Assign a cart to the cart item
            'product_id' => Product::factory(),  // Assign a product to the cart item
            'quantity' => $this->faker->numberBetween(1, 5),  // Random quantity between 1 and 5
            'price_at_time' => $this->faker->randomFloat(2, 10, 100),  // Random price between 10 and 100
        ];
    }
}
