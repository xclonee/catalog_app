<?php

namespace App\Models;

use Database\Factories\MerchantFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'email',
    'password',
    'merchant_name',
    'created_by',
    'updated_by',
])]
#[Hidden([
    'password',
])]
class Merchant extends Authenticatable
{
    /** @use HasFactory<MerchantFactory> */
    use HasFactory, Notifiable;

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function createdMerchants()
    {
        return $this->hasMany(self::class, 'created_by');
    }

    public function updatedMerchants()
    {
        return $this->hasMany(self::class, 'updated_by');
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
