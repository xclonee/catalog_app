<?php

namespace App\Http\Requests;

use App\Models\Merchant;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreStockTransactionRequest extends FormRequest
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

            if (! $productId || ! $qty) {
                return;
            }

            $product = Product::with('category')->find($productId);

            if (! $product || $product->category->merchant_id !== $this->user()->id) {
                $validator->errors()->add('product_id', 'Produk tidak valid untuk merchant Anda.');
            }
        });
    }
}
