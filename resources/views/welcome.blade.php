@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1>Selamat Datang di Aplikasi Pendataan Barang</h1>
    <p>Silakan login untuk mulai mengelola data barang atau melihat katalog.</p>
    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
    <a href="{{ route('barang.user') }}" class="btn btn-success">Lihat Katalog</a>
</div>
@endsection
