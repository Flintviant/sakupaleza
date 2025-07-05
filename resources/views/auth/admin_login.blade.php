@extends('layouts.login')

@section('title', 'Login Admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/adminlogin.css') }}">
@endpush

@section('content')
<h2>Login Admin</h2>
<form method="POST" action="{{ route('admin.login') }}">
    @csrf
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
@endsection
