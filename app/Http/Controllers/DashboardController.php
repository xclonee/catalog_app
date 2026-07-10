<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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

        return view('dashboard.index', compact('merchant', 'totalCategories', 'totalProducts'));
    }
}
