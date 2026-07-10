<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Merchant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'merchant_id' => Merchant::factory(),
            'category_name' => fake()->unique()->word(),
            'description' => fake()->optional()->sentence(),
            'created_by' => null,
            'updated_by' => null,
        ];
    }

    public function forMerchant(Merchant $merchant): static
    {
        return $this->state(fn () => [
            'merchant_id' => $merchant->id,
            'created_by' => $merchant->id,
            'updated_by' => $merchant->id,
        ]);
    }
}
