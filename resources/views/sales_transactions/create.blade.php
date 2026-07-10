@extends('layouts.adminlte')

@section('title', 'Tambah Transaksi Penjualan')
@section('page_title', 'Tambah Transaksi Penjualan')

@section('content')
    <div class="card">
        <form action="{{ route('sales-transactions.store') }}" method="POST">
            @csrf
            <div class="card-body">
                @include('sales_transactions.partials.form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('sales-transactions.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
