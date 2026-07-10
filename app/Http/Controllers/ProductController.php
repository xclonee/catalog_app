<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with('category')
            ->whereHas('category', function ($query): void {
                $query->where('merchant_id', auth()->id());
            })
            ->latest()
            ->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create(): View
    {
        return view('products.create', [
            'product' => new Product,
            'categories' => $this->merchantCategories(),
        ]);
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $imagePath = $request->file('product_image')->store('products', 'public');

        Product::create([
            'sku_product' => $validated['sku_product'],
            'category_id' => $validated['category_id'],
            'product_name' => $validated['product_name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'product_image' => $imagePath,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product): View
    {
        $this->authorizeOwnership($product);

        return view('products.edit', [
            'product' => $product,
            'categories' => $this->merchantCategories(),
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $this->authorizeOwnership($product);

        $validated = $request->validated();

        if ($request->hasFile('product_image')) {
            Storage::disk('public')->delete($product->product_image);
            $validated['product_image'] = $request->file('product_image')->store('products', 'public');
        } else {
            unset($validated['product_image']);
        }

        $product->update([
            ...$validated,
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->authorizeOwnership($product);

        Storage::disk('public')->delete($product->product_image);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    private function merchantCategories()
    {
        return Category::where('merchant_id', auth()->id())
            ->orderBy('category_name')
            ->get();
    }

    private function authorizeOwnership(Product $product): void
    {
        $product->loadMissing('category');

        abort_unless($product->category->merchant_id === auth()->id(), 403);
    }
}
