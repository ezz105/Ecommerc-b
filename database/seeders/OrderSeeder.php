<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // bring all customer type users
        $users = User::where('role_id', 3)->with('addresses')->get();

        // create 10 orders for each user
        foreach ($users as $user) {
            // Randomly pick one address
            $address = $user->addresses->random();  // Get a random address from the collection

            Order::factory()->count(10)->create([
                'user_id' => $user->id,
                'shipping_address_id' => $address->id,
                'billing_address_id' => $address->id,
            ]);
        }

    }
}
