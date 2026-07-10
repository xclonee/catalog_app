@extends('layouts.adminlte')

@section('title', 'Detail Stok Masuk')
@section('page_title', 'Detail Stok Masuk')

@section('content')
    <div class="card">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-4">No Transaksi</dt>
                <dd class="col-sm-8">{{ $stockTransaction->no_transaksi }}</dd>

                <dt class="col-sm-4">Produk</dt>
                <dd class="col-sm-8">{{ $stockTransaction->product->product_name }}</dd>

                <dt class="col-sm-4">Jumlah Masuk</dt>
                <dd class="col-sm-8">{{ $stockTransaction->qty }}</dd>

                <dt class="col-sm-4">Tanggal</dt>
                <dd class="col-sm-8">{{ $stockTransaction->tanggal->format('d M Y H:i') }}</dd>
            </dl>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('stock-transactions.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('stock-transactions.edit', $stockTransaction) }}" class="btn btn-warning">Edit Transaksi</a>
        </div>
    </div>
@endsection
