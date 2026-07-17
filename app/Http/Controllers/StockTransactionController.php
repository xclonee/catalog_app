<?php

namespace App\Http\Controllers;

use App\Exports\StockTransactionsExport;
use App\Http\Requests\StoreStockTransactionRequest;
use App\Http\Requests\UpdateStockTransactionRequest;
use App\Models\Product;
use App\Models\StockTransaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class StockTransactionController extends Controller
{
    public function index(): View
    {
        $transactions = StockTransaction::with('product')
            ->where('merchant_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('stock_transactions.index', compact('transactions'));
    }

    public function create(): View
    {
        $products = Product::with('category')
            ->whereHas('category', function (Builder $query): void {
                $query->where('merchant_id', auth()->id());
            })
            ->orderBy('product_name')
            ->get();

        return view('stock_transactions.create', compact('products'));
    }

    public function store(StoreStockTransactionRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request): void {
            $product = Product::findOrFail($request->product_id);
            $product->increment('stock', $request->qty);

            $transaction = StockTransaction::create([
                'no_transaksi' => 'TEMP'.uniqid(),
                'product_id' => $request->product_id,
                'qty' => $request->qty,
                'transaction_type' => 'masuk',
                'merchant_id' => auth()->id(),
            ]);

            $transaction->update([
                'no_transaksi' => 'STK'.str_pad($transaction->id, 6, '0', STR_PAD_LEFT),
            ]);
        });

        return redirect()->route('stock-transactions.index')->with('success', 'Transaksi stok masuk berhasil disimpan.');
    }

    public function show(StockTransaction $stockTransaction): View
    {
        $this->authorizeMerchant($stockTransaction);

        $stockTransaction->load('product.category');

        return view('stock_transactions.show', compact('stockTransaction'));
    }

    public function edit(StockTransaction $stockTransaction): View
    {
        $this->authorizeMerchant($stockTransaction);

        $products = Product::with('category')
            ->whereHas('category', function (Builder $query): void {
                $query->where('merchant_id', auth()->id());
            })
            ->orderBy('product_name')
            ->get();

        return view('stock_transactions.edit', compact('stockTransaction', 'products'));
    }

    public function update(UpdateStockTransactionRequest $request, StockTransaction $stockTransaction): RedirectResponse
    {
        $this->authorizeMerchant($stockTransaction);

        DB::transaction(function () use ($request, $stockTransaction): void {
            $oldProduct = $stockTransaction->product;
            $newProduct = Product::findOrFail($request->product_id);
            $newQty = $request->qty;

            if ($oldProduct->id === $newProduct->id) {
                $difference = $newQty - $stockTransaction->qty;

                if ($difference > 0) {
                    $newProduct->increment('stock', $difference);
                } elseif ($difference < 0) {
                    $newProduct->decrement('stock', abs($difference));
                }
            } else {
                $oldProduct->decrement('stock', $stockTransaction->qty);
                $newProduct->increment('stock', $newQty);
            }

            $stockTransaction->update([
                'product_id' => $newProduct->id,
                'qty' => $newQty,
            ]);
        });

        return redirect()->route('stock-transactions.show', $stockTransaction)->with('success', 'Transaksi stok masuk berhasil diperbarui.');
    }

    public function exportExcel(): BinaryFileResponse
    {
        return Excel::download(new StockTransactionsExport, 'Stok_Masuk_'.now()->format('Y-m-d_H-i-s').'.xlsx');
    }

    public function exportPdf()
    {
        $transactions = StockTransaction::with('product')
            ->where('merchant_id', auth()->id())
            ->latest()
            ->get();

        $pdf = Pdf::loadView('stock_transactions.pdf', compact('transactions'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('Stok_Masuk_'.now()->format('Y-m-d_H-i-s').'.pdf');
    }

    private function authorizeMerchant(StockTransaction $stockTransaction): void
    {
        abort_unless($stockTransaction->merchant_id === auth()->id(), 403);
    }
}
