<?php

namespace App\Exports;

use App\Models\SalesTransaction;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalesTransactionsExport implements FromQuery, WithHeadings, WithMapping
{
    public function query()
    {
        return SalesTransaction::with('product')
            ->where('merchant_id', auth()->id())
            ->latest();
    }

    public function headings(): array
    {
        return [
            'No Transaksi',
            'Produk',
            'Qty',
            'Tanggal',
        ];
    }

    public function map($row): array
    {
        return [
            $row->no_transaksi,
            $row->product->product_name,
            $row->qty,
            $row->tanggal->format('d M Y H:i'),
        ];
    }
}
