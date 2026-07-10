<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Komponen Management: Recent Sales</h3>
    </div>
    <div class="card-body">
        <p>Transaksi penjualan terbaru:</p>

        @if ($recentSales->isEmpty())
            <div class="alert alert-secondary">Belum ada transaksi penjualan.</div>
        @else
            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Transaksi</th>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentSales as $sale)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sale->no_transaksi }}</td>
                                <td>{{ $sale->product_name }}</td>
                                <td>{{ $sale->qty }}</td>
                                <td>{{ \Carbon\Carbon::parse($sale->tanggal)->format('d M Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
