<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderItem;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('role_id', 3)->get();
        $products = Product::all();
        $orderItems = OrderItem::all();

        foreach ($orderItems as $orderItem) {
            // Create a review for each order item, if associated product and user exist
            $product = $products->where('id', $orderItem->product_id)->first();
            $user = $users->where('id', $orderItem->artisan_id)->first();

            if ($product && $user) {
                Review::factory()->create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'order_item_id' => $orderItem->id,
                ]);
            }
        }
    }
}
