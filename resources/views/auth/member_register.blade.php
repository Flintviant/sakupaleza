@extends('layouts.login')

@section('title', 'Daftar Member')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/daftar.css') }}">
@endpush

@section('content')
<div class="container" style="max-width: 500px; margin: 40px auto;">
    <h2 class="text-center mb-4">Daftar Akun Member</h2>

    @if (session('success'))
        <div style="background: #d4edda; padding: 10px; border-radius: 5px; color: #155724;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="background: #f8d7da; padding: 10px; border-radius: 5px; color: #721c24;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('member.register') }}">
        @csrf
        <div style="margin-bottom: 15px;">
            <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required style="width: 100%; padding: 10px;">
        </div>
        <div style="margin-bottom: 15px;">
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required style="width: 100%; padding: 10px;">
        </div>
        <div style="margin-bottom: 15px;">
            <input type="password" name="password" placeholder="Password" required style="width: 100%; padding: 10px;">
        </div>
        <div style="margin-bottom: 15px;">
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required style="width: 100%; padding: 10px;">
        </div>
        <div>
            <button type="submit" style="padding: 10px 20px; width: 100%; background: #343a40; color: white; border: none; border-radius: 4px;">
                Daftar Sekarang
            </button>
        </div>
    </form>

    <p class="text-center" style="margin-top: 15px;">
        Sudah punya akun?
        <a href="{{ route('member.form') }}">Login sekarang</a>
    </p>
</div>
@endsection
