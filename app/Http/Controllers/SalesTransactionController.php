<?php

namespace App\Http\Controllers;

use App\Exports\SalesTransactionsExport;
use App\Http\Requests\StoreSalesTransactionRequest;
use App\Http\Requests\UpdateSalesTransactionRequest;
use App\Models\Product;
use App\Models\SalesTransaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SalesTransactionController extends Controller
{
    public function index(): View
    {
        $transactions = SalesTransaction::with('product')
            ->where('merchant_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('sales_transactions.index', compact('transactions'));
    }

    public function create(): View
    {
        $products = Product::with('category')
            ->whereHas('category', function (Builder $query): void {
                $query->where('merchant_id', auth()->id());
            })
            ->where('stock', '>', 0)
            ->orderBy('product_name')
            ->get();

        return view('sales_transactions.create', compact('products'));
    }

    public function store(StoreSalesTransactionRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request): void {
            $product = Product::findOrFail($request->product_id);
            $product->decrement('stock', $request->qty);

            $transaction = SalesTransaction::create([
                'no_transaksi' => 'TEMP'.uniqid(),
                'product_id' => $request->product_id,
                'qty' => $request->qty,
                'merchant_id' => auth()->id(),
            ]);

            $transaction->update([
                'no_transaksi' => 'ST'.str_pad($transaction->id, 6, '0', STR_PAD_LEFT),
            ]);
        });

        return redirect()->route('sales-transactions.index')->with('success', 'Transaksi penjualan berhasil disimpan.');
    }

    public function show(SalesTransaction $salesTransaction): View
    {
        $this->authorizeMerchant($salesTransaction);

        $salesTransaction->load('product.category');

        return view('sales_transactions.show', compact('salesTransaction'));
    }

    public function edit(SalesTransaction $salesTransaction): View
    {
        $this->authorizeMerchant($salesTransaction);

        $products = Product::with('category')
            ->whereHas('category', function (Builder $query): void {
                $query->where('merchant_id', auth()->id());
            })
            ->orderBy('product_name')
            ->get();

        return view('sales_transactions.edit', compact('salesTransaction', 'products'));
    }

    public function update(UpdateSalesTransactionRequest $request, SalesTransaction $salesTransaction): RedirectResponse
    {
        $this->authorizeMerchant($salesTransaction);

        DB::transaction(function () use ($request, $salesTransaction): void {
            $oldProduct = $salesTransaction->product;
            $newProduct = Product::findOrFail($request->product_id);
            $newQty = $request->qty;

            if ($oldProduct->id === $newProduct->id) {
                $difference = $newQty - $salesTransaction->qty;

                if ($difference > 0) {
                    $newProduct->decrement('stock', $difference);
                } elseif ($difference < 0) {
                    $newProduct->increment('stock', abs($difference));
                }
            } else {
                $oldProduct->increment('stock', $salesTransaction->qty);
                $newProduct->decrement('stock', $newQty);
            }

            $salesTransaction->update([
                'product_id' => $newProduct->id,
                'qty' => $newQty,
            ]);
        });

        return redirect()->route('sales-transactions.show', $salesTransaction)->with('success', 'Transaksi penjualan berhasil diperbarui.');
    }

    public function exportExcel(): BinaryFileResponse
    {
        return Excel::download(new SalesTransactionsExport, 'Transaksi_Penjualan_'.now()->format('Y-m-d_H-i-s').'.xlsx');
    }

    public function exportPdf()
    {
        $transactions = SalesTransaction::with('product')
            ->where('merchant_id', auth()->id())
            ->latest()
            ->get();

        $pdf = Pdf::loadView('sales_transactions.pdf', compact('transactions'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('Transaksi_Penjualan_'.now()->format('Y-m-d_H-i-s').'.pdf');
    }

    private function authorizeMerchant(SalesTransaction $salesTransaction): void
    {
        abort_unless($salesTransaction->merchant_id === auth()->id(), 403);
    }
}
