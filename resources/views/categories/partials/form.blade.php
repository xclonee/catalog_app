<div class="form-group">
    <label for="category_name">Nama Kategori</label>
    <input
        type="text"
        name="category_name"
        id="category_name"
        class="form-control @error('category_name') is-invalid @enderror"
        value="{{ old('category_name', $category->category_name) }}"
        required
    >
    @error('category_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="description">Deskripsi</label>
    <textarea
        name="description"
        id="description"
        rows="4"
        class="form-control @error('description') is-invalid @enderror"
    >{{ old('description', $category->description) }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
