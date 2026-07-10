@extends('layouts.adminlte')

@section('title', 'Stok Masuk')
@section('page_title', 'Stok Masuk')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Daftar Stok Masuk</h3>
            <a href="{{ route('stock-transactions.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-1"></i> Tambah Stok Masuk
            </a>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-bordered table-striped mb-0">
                <thead>
                    <tr>
                        <th>No Transaksi</th>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->no_transaksi }}</td>
                            <td>{{ $transaction->product->product_name }}</td>
                            <td>{{ $transaction->qty }}</td>
                            <td>{{ $transaction->tanggal->format('d M Y H:i') }}</td>
                            <td>
                                <a href="{{ route('stock-transactions.show', $transaction) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('stock-transactions.edit', $transaction) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada transaksi stok masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($transactions->hasPages())
            <div class="card-footer">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
@endsection
