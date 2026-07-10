<?php

namespace App\Http\Requests;

use App\Models\Merchant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() instanceof Merchant;
    }

    protected function prepareForValidation(): void
    {
        if (! $this->has('price')) {
            return;
        }

        $price = preg_replace('/\D+/', '', (string) $this->input('price'));

        $this->merge([
            'price' => $price === '' ? null : $price,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'sku_product' => ['required', 'string', 'max:255', 'unique:products,sku_product'],
            'category_id' => [
                'required',
                'integer',
                Rule::exists('categories', 'id')->where('merchant_id', $this->user()->id),
            ],
            'product_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'product_image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }
}
