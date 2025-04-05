@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Faktur Pembelian</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(!empty($keranjang) && count($keranjang) > 0)
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($keranjang as $item)
                <tr>
                    <td>{{ $item['nama'] }}</td>
                    <td>Rp. {{ number_format($item['harga']) }}</td>
                    <td>{{ $item['qty'] }}</td>
                    <td>Rp. {{ number_format($item['harga'] * $item['qty']) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h5 class="text-end">Total: <strong>Rp. {{ number_format($total) }}</strong></h5>

        <form action="{{ route('faktur.simpan') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-3">
                <label>Alamat Pengiriman</label>
                <textarea name="alamat" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label>Kode Pos</label>
                <input type="text" name="kode_pos" class="form-control" required pattern="\d{5}">
            </div>
            <button class="btn btn-primary">Simpan & Cetak Faktur</button>
        </form>
    @elseif(isset($faktur))
        {{-- Tampilkan info faktur setelah disimpan --}}
        <div class="alert alert-success">
            Faktur berhasil disimpan dengan nomor: <strong>{{ $faktur->nomor_invoice }}</strong>
        </div>

        <a href="{{ route('faktur.cetak', $faktur->id) }}" class="btn btn-outline-secondary">Cetak Faktur (PDF)</a>
        <a href="{{ route('barang.user') }}" class="btn btn-primary">Kembali ke Katalog</a>
    @else
        <div class="alert alert-info">Keranjang kosong. Silakan pilih barang terlebih dahulu.</div>
        <a href="{{ route('barang.user') }}" class="btn btn-secondary">Kembali ke Katalog</a>
    @endif
</div>
@endsection
