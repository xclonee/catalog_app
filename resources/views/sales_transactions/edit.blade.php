@extends('layouts.adminlte')

@section('title', 'Edit Transaksi Penjualan')
@section('page_title', 'Edit Transaksi Penjualan')

@section('content')
    <div class="card">
        <form action="{{ route('sales-transactions.update', $salesTransaction) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                @include('sales_transactions.partials.form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('sales-transactions.show', $salesTransaction) }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
