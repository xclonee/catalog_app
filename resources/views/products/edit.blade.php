@extends('layouts.adminlte')

@section('title', 'Edit Produk')
@section('page_title', 'Edit Produk')

@section('content')
    <div class="card">
        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                @include('products.partials.form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
