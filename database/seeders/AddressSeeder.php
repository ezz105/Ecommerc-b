<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Address;
use App\Models\User;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // bring all customer type users
                $users = User::where('role_id', 3)->get();

                // create 3 addresses for each user
                foreach ($users as $user) {
                    Address::factory()->count(3)->create([
                        'user_id' => $user->id,
                    ]);
                }
    }
}
