<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
        }
        .header p {
            margin: 5px 0;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            font-size: 11px;
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Transaksi Penjualan</h1>
        <p>Tanggal: {{ now()->format('d M Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No Transaksi</th>
                <th>Produk</th>
                <th style="text-align: center; width: 100px;">Qty</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->no_transaksi }}</td>
                    <td>{{ $transaction->product->product_name }}</td>
                    <td style="text-align: center;">{{ $transaction->qty }}</td>
                    <td>{{ $transaction->tanggal->format('d M Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Belum ada transaksi penjualan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Laporan ini dicetak pada {{ now()->format('d M Y H:i:s') }}</p>
    </div>
</body>
</html>
