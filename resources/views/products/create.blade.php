@extends('layouts.adminlte')

@section('title', 'Tambah Produk')
@section('page_title', 'Tambah Produk')

@section('content')
    <div class="card">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                @include('products.partials.form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
