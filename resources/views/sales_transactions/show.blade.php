@extends('layouts.adminlte')

@section('title', 'Detail Transaksi Penjualan')
@section('page_title', 'Detail Transaksi Penjualan')

@section('content')
    <div class="card">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-4">No Transaksi</dt>
                <dd class="col-sm-8">{{ $salesTransaction->no_transaksi }}</dd>

                <dt class="col-sm-4">Produk</dt>
                <dd class="col-sm-8">{{ $salesTransaction->product->product_name }}</dd>

                <dt class="col-sm-4">Kategori</dt>
                <dd class="col-sm-8">{{ $salesTransaction->product->category->category_name }}</dd>

                <dt class="col-sm-4">Jumlah Terjual</dt>
                <dd class="col-sm-8">{{ $salesTransaction->qty }}</dd>

                <dt class="col-sm-4">Tanggal</dt>
                <dd class="col-sm-8">{{ $salesTransaction->tanggal->format('d M Y H:i') }}</dd>
            </dl>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('sales-transactions.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('sales-transactions.edit', $salesTransaction) }}" class="btn btn-warning">Edit Transaksi</a>
        </div>
    </div>
@endsection
