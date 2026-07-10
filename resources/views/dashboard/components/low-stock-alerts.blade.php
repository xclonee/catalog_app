<div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">Komponen Management: Low Stock Alerts</h3>
    </div>
    <div class="card-body">
        <p>Daftar produk dengan stok rendah (kurang dari 10):</p>
        @if ($lowStockProducts->isEmpty())
            <div class="alert alert-secondary">Tidak ada produk dengan stok rendah saat ini.</div>
        @else
            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lowStockProducts as $product)
                            <tr>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->stock }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
