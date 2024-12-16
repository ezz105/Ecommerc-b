<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\CartItem;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //brings all carts
        $carts = Cart::all();

        // creates 1 cart item for each cart
        foreach ($carts as $cart) {
            CartItem::factory()->create([
                'cart_id' => $cart->id,
            ]);
        }
    }
}
