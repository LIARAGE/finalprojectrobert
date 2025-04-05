<!DOCTYPE html>
<html>
<head>
    <title>Faktur {{ $faktur->nomor_invoice }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; padding: 8px; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2>Faktur - {{ $faktur->nomor_invoice }}</h2>
    <p><strong>Alamat:</strong> {{ $faktur->alamat }}<br>
    <strong>Kode Pos:</strong> {{ $faktur->kode_pos }}</p>

    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($faktur->details as $detail)
            <tr>
                <td>{{ $detail->nama_barang }}</td>
                <td>Rp. {{ number_format($detail->harga) }}</td>
                <td>{{ $detail->qty }}</td>
                <td>Rp. {{ number_format($detail->subtotal) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4 style="text-align: right;">Total: Rp. {{ number_format($faktur->total_harga) }}</h4>
</body>
</html>
