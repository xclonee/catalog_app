<div class="form-group">
    <label for="sku_product">SKU Produk</label>
    <input
        type="text"
        name="sku_product"
        id="sku_product"
        class="form-control @error('sku_product') is-invalid @enderror"
        value="{{ old('sku_product', $product->sku_product) }}"
        required
    >
    @error('sku_product')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="category_id">Kategori</label>
    <select
        name="category_id"
        id="category_id"
        class="form-control @error('category_id') is-invalid @enderror"
        required
    >
        <option value="">Pilih kategori</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                {{ $category->category_name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="product_name">Nama Produk</label>
    <input
        type="text"
        name="product_name"
        id="product_name"
        class="form-control @error('product_name') is-invalid @enderror"
        value="{{ old('product_name', $product->product_name) }}"
        required
    >
    @error('product_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@php
    $rawPrice = old('price', $product->price);
    $priceDigits = preg_replace('/\D+/', '', (string) $rawPrice);
    $formattedPrice = $priceDigits === '' ? '' : number_format((int) $priceDigits, 0, ',', '.');
@endphp

<div class="form-group">
    <label for="price">Harga</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">Rp</span>
        </div>
        <input
            type="text"
            name="price"
            id="price"
            class="form-control @error('price') is-invalid @enderror"
            value="{{ $formattedPrice }}"
            inputmode="numeric"
            autocomplete="off"
            data-rupiah-input
            required
        >
    </div>
    @error('price')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="description">Deskripsi</label>
    <textarea
        name="description"
        id="description"
        rows="4"
        class="form-control @error('description') is-invalid @enderror"
    >{{ old('description', $product->description) }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@if ($product->product_image)
    <div class="form-group">
        <label>Image Saat Ini</label>
        <div>
            <img
                src="{{ asset('storage/' . $product->product_image) }}"
                alt="{{ $product->product_name }}"
                style="width: 120px; height: 120px; object-fit: cover;"
            >
        </div>
    </div>
@endif

<div class="form-group">
    <label for="product_image">Image Produk</label>
    <input
        type="file"
        name="product_image"
        id="product_image"
        class="form-control-file @error('product_image') is-invalid @enderror"
        accept=".jpg,.jpeg,.png"
        @required(! $product->exists)
    >
    @error('product_image')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

@once
    @push('scripts')
        <script>
            document.querySelectorAll('[data-rupiah-input]').forEach((input) => {
                input.addEventListener('input', () => {
                    const digits = input.value.replace(/\D/g, '');

                    input.value = digits.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                });
            });
        </script>
    @endpush
@endonce
