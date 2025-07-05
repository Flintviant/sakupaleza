@extends('layouts.app')

@section('title', 'Galeri')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/galeri.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('js/carousel.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@endpush

@section('content')
    <!-- Header Section -->
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
        </div>
    </header>
{{-- Carousel --}}
<section class="carousel">
    <div class="carousel-container">
        <button class="prev">&#10094;</button>
        <img src="{{ asset('image/sakupaleza-1.jpg') }}" id="carousel-image" alt="Carousel">
        <button class="next">&#10095;</button>
    </div>
</section>

{{-- Galeri Grid --}}
<section class="gallery-grid">
    @forelse ($galeri as $galeri)
        <div class="card">
            @if ($galeri->gambar)
                <img src="{{ asset('storage/' . $galeri->gambar) }}" alt="Galeri">
            @else
                <img src="{{ asset('image/default.jpg') }}" alt="Tidak Ada Gambar">
            @endif
        </div>
    @empty
        <p>Tidak ada foto galeri.</p>
    @endforelse
</section>
@endsection
