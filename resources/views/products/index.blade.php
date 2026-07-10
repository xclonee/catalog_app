@extends('layouts.adminlte')

@section('title', 'Produk')
@section('page_title', 'Produk')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-1"></i> Tambah Produk
            </a>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-bordered table-striped mb-0">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>SKU</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th style="width: 160px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>
                                <img
                                    src="{{ asset('storage/' . $product->product_image) }}"
                                    alt="{{ $product->product_name }}"
                                    style="width: 64px; height: 64px; object-fit: cover;"
                                >
                            </td>
                            <td>{{ $product->sku_product }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ Str::limit($product->description ?? '-', 80) }}</td>
                            <td>{{ $product->category->category_name }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($products->hasPages())
            <div class="card-footer">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
