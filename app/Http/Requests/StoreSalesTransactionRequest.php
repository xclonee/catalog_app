<?php

namespace App\Http\Requests;

use App\Models\Merchant;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSalesTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() instanceof Merchant;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'product_id' => [
                'required',
                'integer',
                Rule::exists('products', 'id'),
            ],
            'qty' => ['required', 'integer', 'min:1'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator): void {
            $productId = $this->input('product_id');
            $qty = $this->input('qty');

            if (! $productId || ! $qty) {
                return;
            }

            $product = Product::with('category')->find($productId);

            if (! $product || $product->category->merchant_id !== $this->user()->id) {
                $validator->errors()->add('product_id', 'Produk tidak valid untuk merchant Anda.');

                return;
            }

            if ($qty > $product->stock) {
                $validator->errors()->add('qty', 'Stok produk tidak mencukupi.');
            }
        });
    }
}
