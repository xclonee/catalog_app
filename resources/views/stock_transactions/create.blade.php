@extends('layouts.adminlte')

@section('title', 'Tambah Stok Masuk')
@section('page_title', 'Tambah Stok Masuk')

@section('content')
    <div class="card">
        <form action="{{ route('stock-transactions.store') }}" method="POST">
            @csrf

            <div class="card-body">
                @include('stock_transactions.partials.form')
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('stock-transactions.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
