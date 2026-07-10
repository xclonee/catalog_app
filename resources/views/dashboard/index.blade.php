@extends('layouts.adminlte')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
    <div class="alert alert-info">
        Selamat datang, <strong>{{ $merchant->merchant_name }}</strong>.
        <br>
        Ini adalah ringkasan utama aplikasi yang membantu Anda memantau kinerja bisnis secara cepat.
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">System Insight</h3>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <a href="{{ route('stock-transactions.create') }}" class="btn btn-success btn-lg btn-block">
                            <i class="fas fa-dolly-flatbed mr-2"></i> + Stok Masuk
                        </a>
                    </div>
                    <div class="col-md-6 mb-2">
                        <a href="{{ route('sales-transactions.create') }}" class="btn btn-primary btn-lg btn-block">
                            <i class="fas fa-shopping-cart mr-2"></i> + Transaksi Penjualan
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalCategories }}</h3>
                            <p>Total Kategori</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tags"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $totalProducts }}</h3>
                            <p>Total Produk</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $totalStock }}</h3>
                            <p>Jumlah Stok Tersedia</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-layer-group"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $totalSalesTransactions }}</h3>
                            <p>Transaksi Penjualan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            @include('dashboard.components.low-stock-alerts')
        </div>
        <div class="col-lg-6">
            @include('dashboard.components.recent-sales')
        </div>
    </div>
@endsection
