<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cart;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // bring all customer type users
        $users = User::where('role_id', 3)->get();

        // create 1 cart for each user
        foreach ($users as $user) {
            Cart::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
