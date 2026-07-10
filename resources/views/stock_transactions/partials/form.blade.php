<div class="form-group">
    <label for="product_id">Produk</label>
    <select
        name="product_id"
        id="product_id"
        class="form-control @error('product_id') is-invalid @enderror"
        required
    >
        <option value="">Pilih produk</option>
        @foreach ($products as $product)
            <option value="{{ $product->id }}" @selected(old('product_id', isset($stockTransaction) ? $stockTransaction->product_id : null) == $product->id)>
                {{ $product->product_name }} (Stok: {{ $product->stock }})
            </option>
        @endforeach
    </select>
    @error('product_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="qty">Jumlah Masuk</label>
    <input
        type="number"
        name="qty"
        id="qty"
        class="form-control @error('qty') is-invalid @enderror"
        value="{{ old('qty', $stockTransaction->qty ?? 1) }}"
        min="1"
        required
    >
    @error('qty')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
