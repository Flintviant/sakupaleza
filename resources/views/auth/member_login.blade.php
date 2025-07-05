@extends('layouts.login')

@section('title', 'Login')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
<h2>Login Member</h2>
<form method="POST" action="{{ route('member.login') }}">
    @csrf
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

<p style="margin-top: 10px;">
    Belum punya akun?
<a href="{{ route('member.register.form') }}">Daftar sekarang</a> {{-- BENAR --}}
</p>
@endsection