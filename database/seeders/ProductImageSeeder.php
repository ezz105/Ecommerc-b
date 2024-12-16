<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductImage;
use App\Models\Product;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ProductImage::factory()->count(3)->create();

        // Get all products and create 3 images for each
        $products = Product::all();
        foreach ($products as $product) {
            ProductImage::factory()->count(3)->create([
                'product_id' => $product->id,
            ]);
        }
    }
}
