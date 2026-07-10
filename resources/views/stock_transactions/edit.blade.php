@extends('layouts.adminlte')

@section('title', 'Edit Stok Masuk')
@section('page_title', 'Edit Stok Masuk')

@section('content')
    <div class="card">
        <form action="{{ route('stock-transactions.update', $stockTransaction) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">
                @include('stock_transactions.partials.form')
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('stock-transactions.show', $stockTransaction) }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
