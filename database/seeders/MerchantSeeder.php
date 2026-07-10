<?php

namespace Database\Seeders;

use App\Models\Merchant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MerchantSeeder extends Seeder
{
    public function run(): void
    {
        $merchant = Merchant::updateOrCreate(
            ['email' => 'merchant@example.com'],
            [
                'merchant_name' => 'Merchant Demo',
                'password' => Hash::make('password'),
            ],
        );

        $merchant->forceFill([
            'created_by' => $merchant->id,
            'updated_by' => $merchant->id,
        ])->save();
    }
}
