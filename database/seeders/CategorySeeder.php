<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Merchant;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $merchant = Merchant::where('email', 'merchant@example.com')->firstOrFail();

        foreach (['Makanan', 'Minuman', 'Kerajinan'] as $categoryName) {
            Category::updateOrCreate(
                [
                    'merchant_id' => $merchant->id,
                    'category_name' => $categoryName,
                ],
                [
                    'description' => 'Kategori '.$categoryName.' untuk katalog merchant demo.',
                    'created_by' => $merchant->id,
                    'updated_by' => $merchant->id,
                ],
            );
        }
    }
}
