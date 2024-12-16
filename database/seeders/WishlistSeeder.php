<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wishlist;
use App\Models\User;
use App\Models\Product;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $products = Product::all();

        foreach ($users as $user) {
            // Adding 5 products to each user's wishlist
            $productIds = $products->random(5)->pluck('id');

            foreach ($productIds as $productId) {
                Wishlist::factory()->create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                ]);
            }
        }
    }
}
