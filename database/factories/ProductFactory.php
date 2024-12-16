<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(3, true);
        return [
            'artisan_id' => User::factory(), 
            'category_id' => Category::factory(),
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 500),
            'discount_price' => $this->faker->optional()->randomFloat(2, 5, 450),
            'stock_quantity' => $this->faker->numberBetween(1, 100),
            'sku' => strtoupper($this->faker->unique()->lexify('SKU???')),
            'status' => $this->faker->randomElement(['draft', 'active', 'inactive', 'out_of_stock']),
            'is_featured' => $this->faker->boolean,
            'meta_title' => $this->faker->sentence,
            'meta_description' => $this->faker->sentence,
        ];
    }
}
