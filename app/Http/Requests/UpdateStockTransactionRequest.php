<?php

namespace App\Http\Requests;

use App\Models\Merchant;
use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateStockTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() instanceof Merchant;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', Rule::exists('products', 'id')],
            'qty' => ['required', 'integer', 'min:1'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            $productId = $this->input('product_id');
            $qty = $this->input('qty');
            /** @var StockTransaction|null $stockTransaction */
            $stockTransaction = $this->route('stock_transaction');

            if (! $productId || ! $qty || ! $stockTransaction) {
                return;
            }

            $product = Product::with('category')->find($productId);

            if (! $product || $product->category->merchant_id !== $this->user()->id) {
                $validator->errors()->add('product_id', 'Produk tidak valid untuk merchant Anda.');

                return;
            }

            if ($stockTransaction->product_id === $productId) {
                $difference = $qty - $stockTransaction->qty;

                if ($difference < 0 && $product->stock < abs($difference)) {
                    $validator->errors()->add('qty', 'Perubahan jumlah stok tidak dapat membuat stok menjadi negatif.');
                }

                return;
            }

            $oldProduct = Product::with('category')->find($stockTransaction->product_id);

            if (! $oldProduct || $oldProduct->category->merchant_id !== $this->user()->id) {
                $validator->errors()->add('product_id', 'Produk lama tidak valid untuk merchant Anda.');

                return;
            }

            if ($oldProduct->stock < $stockTransaction->qty) {
                $validator->errors()->add('product_id', 'Produk lama tidak memiliki stok yang cukup untuk perubahan transaksi.');
            }
        });
    }
}
