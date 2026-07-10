<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $merchant = auth()->user();

        $totalCategories = Category::where('merchant_id', $merchant->id)->count();
        $totalProducts = Product::whereHas('category', function ($query) use ($merchant): void {
            $query->where('merchant_id', $merchant->id);
        })->count();

        $totalStock = Product::whereHas('category', function ($query) use ($merchant): void {
            $query->where('merchant_id', $merchant->id);
        })->sum('stock');

        $totalSalesTransactions = DB::table('sales_transactions')
            ->where('merchant_id', $merchant->id)
            ->count();

        $lowStockProducts = Product::whereHas('category', function ($query) use ($merchant): void {
            $query->where('merchant_id', $merchant->id);
        })->where('stock', '<', 10)
            ->orderBy('stock', 'asc')
            ->limit(5)
            ->get();

        $recentSales = DB::table('sales_transactions')
            ->join('products', 'sales_transactions.product_id', '=', 'products.id')
            ->where('sales_transactions.merchant_id', $merchant->id)
            ->orderBy('sales_transactions.tanggal', 'desc')
            ->limit(5)
            ->select(
                'sales_transactions.no_transaksi as no_transaksi',
                'sales_transactions.tanggal as tanggal',
                'products.product_name as product_name',
                'sales_transactions.qty as qty'
            )
            ->get();

        return view('dashboard.index', compact(
            'merchant',
            'totalCategories',
            'totalProducts',
            'totalStock',
            'totalSalesTransactions',
            'lowStockProducts',
            'recentSales'
        ));
    }
}
