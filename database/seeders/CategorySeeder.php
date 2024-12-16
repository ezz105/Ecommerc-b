<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $categories = Category::factory(5)->create(); // create 5 categories

       //nested categories , each category with 3 subcategories
        foreach ($categories as $category) {
            Category::factory(3)->create(['parent_id' => $category->id]);
        }
    }
}
