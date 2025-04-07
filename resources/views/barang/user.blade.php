@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Katalog Barang</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($barangs as $barang)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow">
                    @if($barang->foto)
                        <img src="{{ asset('storage/' . $barang->foto) }}" class="card-img-top" style="height:200px; object-fit:cover;">
                    @else
                        <div class="card-img-top bg-secondary text-white text-center p-5">Tidak ada gambar</div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $barang->nama }}</h5>
                        <p class="mb-2">
                            <strong>Kategori:</strong> {{ $barang->kategori->nama }}<br>
                            <strong>Harga:</strong> Rp. {{ number_format($barang->harga) }}<br>
                            <strong>Stok:</strong> {{ $barang->jumlah }}
                        </p>

                        @if($barang->jumlah > 0)
                            <form action="{{ route('keranjang.tambah', $barang->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success w-100">+ Masukkan ke Faktur</button>
                            </form>
                        @else
                            <div class="alert alert-danger text-center p-2 mt-2 mb-0">
                                Stok habis!
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Belum ada barang tersedia.</p>
        @endforelse
    </div>

    <a href="{{ route('faktur.index') }}" class="btn btn-primary mt-3">Lihat Faktur</a>
</div>
@endsection
