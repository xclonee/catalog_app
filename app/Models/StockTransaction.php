<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_transaksi',
        'product_id',
        'qty',
        'transaction_type',
        'merchant_id',
    ];

    protected $casts = [
        'qty' => 'integer',
        'tanggal' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
}
