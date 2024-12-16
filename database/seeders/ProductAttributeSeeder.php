<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductAttribute;

class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all products and create attributes for each
        $products = Product::all();
        foreach ($products as $product) {
            ProductAttribute::factory()->count(3)->create([
                'product_id' => $product->id,
            ]);
        }
    }
}

