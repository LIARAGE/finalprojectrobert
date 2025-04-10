@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 500px">
    <h3 class="mb-4">Register</h3>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="name" class="form-control" required minlength="3" maxlength="40">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required placeholder="example@gmail.com">
        </div>

        <div class="mb-3">
            <label>Nomor HP</label>
            <input type="text" name="phone" class="form-control" required pattern="08[0-9]+" title="Harus diawali 08">
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required minlength="6" maxlength="12">
        </div>

        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button class="btn btn-success w-100">Daftar</button>
    </form>
</div>
@endsection
