@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <form method="POST" action="{{ route('login') }}" class="w-50 mx-auto">
    @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
        <button type="submit" class="btn btn-primary">Login</button>
        </div>
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </form>
</div>
@endsection
