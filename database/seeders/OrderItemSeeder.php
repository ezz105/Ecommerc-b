<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get all orders and create order items for each order
        $orders = Order::all();

        foreach ($orders as $order) {

            $product = Product::inRandomOrder()->first();
            $artisan = User::where('role_id', 3)->inRandomOrder()->first();

            // create 3 order items for each order
            OrderItem::factory()->count(3)->create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'artisan_id' => $artisan->id,
            ]);
        }
    }
}
