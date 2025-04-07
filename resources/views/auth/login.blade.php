@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 500px">
    <h3 class="mb-4">Login</h3>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required placeholder="example@gmail.com">
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100">Login</button>
    </form>
</div>
@endsection
