<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light">Smart-Catalog</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link @class(['active' => request()->routeIs('dashboard')])">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link @class(['active' => request()->routeIs('categories.*')])">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link @class(['active' => request()->routeIs('products.*')])">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Produk</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sales-transactions.index') }}" class="nav-link @class(['active' => request()->routeIs('sales-transactions.*')])">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Transaksi Penjualan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('stock-transactions.index') }}" class="nav-link @class(['active' => request()->routeIs('stock-transactions.*')])">
                        <i class="nav-icon fas fa-dolly-flatbed"></i>
                        <p>Stok Masuk</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
