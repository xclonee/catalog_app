<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Merchant;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sku_product' => fake()->unique()->bothify('SKU-####'),
            'category_id' => Category::factory(),
            'product_name' => fake()->words(3, true),
            'description' => fake()->optional()->sentence(),
            'price' => fake()->numberBetween(1000, 1000000),
            'product_image' => 'products/demo.jpg',
            'created_by' => null,
            'updated_by' => null,
        ];
    }

    public function forMerchant(Merchant $merchant, ?Category $category = null): static
    {
        return $this->state(function () use ($merchant, $category) {
            $category ??= Category::factory()->forMerchant($merchant)->create();

            return [
                'category_id' => $category->id,
                'created_by' => $merchant->id,
                'updated_by' => $merchant->id,
            ];
        });
    }
}
