@extends('layouts.app')

@section('title', 'Menu')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('js/app.js') }}"></script>
@endpush
@section('content')
<header>
        <div class="container">
            <nav class="navbar">
                <div class="logo">SAKUPALEZA</div>
                <div class="hamburger" id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <ul class="nav-links" id="navLinks">
                    <li><a href="/">HOME</a></li>
                    <li><a href="/tentang">TENTANG</a></li>
                    <li><a href="{{ route('berita.landing')}}">BERITA</a></li>
                    <li><a href="{{ route('galeri.landing')}}">GALERI</a></li>
                    <li><a href="{{ route('menu.index')}}">MENU</a></li>
                    <li><a href="{{ route('order.create')}}">ORDER</a></li>
                    <li><a href="{{ route('kontak.landing')}}">KONTAK</a></li>
                    @auth('member')
                    <li>
                        <a href="{{ route('member.dashboard') }}">
                            Hi, {{ Auth::guard('member')->user()->name }}
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="logout-form" style="display: inline;">
                            @csrf
                            <button type="submit" style="background: none; border: none; color: black; cursor: pointer;">
                                LOGOUT
                            </button>
                        </form>
                    </li>
                    @else
                        <li><a href="{{ route('member.form') }}">LOGIN</a></li>
                    @endauth
                </ul>
            </nav>
    </header>
<section class="menu-section">
    <div class="container">
        <h2>Daftar Menu</h2>
        <div class="menu-grid">
           @foreach($menus as $menu)
<div class="menu-card">
    @if($menu->gambar)
    <img src="{{ asset('storage/'.$menu->gambar) }}" alt="{{ $menu->nama }}">
    @endif
    <h3>{{ $menu->nama }}</h3>
    <p>{{ $menu->deskripsi }}</p>
    <p><strong>Rp {{ number_format($menu->harga,0,',','.') }}</strong></p>

    <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
        <input type="number" name="jumlah" value="1" min="1" style="width:60px;">
        <button type="submit">Tambah ke Keranjang</button>
    </form>
</div>
@endforeach

        </div>
    </div>
</section>
@endsection
