<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductImage>
 */
class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            //'image_path' => 'images/' . $this->faker->image(sys_get_temp_dir(), 640, 480, null, false),
            'image_path' => $this->faker->imageUrl(640, 480, 'product'),
            'is_primary' => $this->faker->boolean(20), // 20% chance of being primary
            'sort_order' => $this->faker->numberBetween(1, 10),
        ];
    }
}
