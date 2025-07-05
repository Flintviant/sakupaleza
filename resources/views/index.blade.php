@extends('layouts.app')

@section('title', 'Home')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush
@push('scripts')
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

            <div class="header-content">
                <h2><strong>SAKUPALEZA</strong></h2>
                <p>Restoran dengan cita rasa tradisional yang autentik</p>
                <a href="/tentang" class="btn">TENTANG KAMI</a>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section class="about-section">
        <div class="about-header">
            <h1>TENTANG KAMI</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
            <div class="about-line"></div>
        </div>
    </section>

    <div class="about-content">
    @for ($i = 1; $i <= 6; $i++)
    <div class="image">
        <img src="{{ asset("image/sakupaleza-$i.jpg") }}" alt="Food Image">
        <div class="about-card">
            <h3>Produk {{ $i }}</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
            {{-- <button class="btn-cart" onclick="tambahKeKeranjang({{ $i }})">Tambah ke Keranjang</button> --}}
        </div>
    </div>
    @endfor
    </div>

    <!-- News Section -->
    <section class="news-section">
    <h1 class="section-title">BERITA KAMI</h1>
    <div class="news-grid">
        @foreach ($berita as $item)
        <div class="news-card">
            @if($item->gambar)
                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">
            @else
                <img src="{{ asset('image/default.jpg') }}" alt="No Image">
            @endif
            <div class="card-body">
                <h4>{{ $item->judul }}</h4>
                <p>{{ Str::limit(strip_tags($item->konten), 100) }}</p>
                @if($item->link)
                    <a href="{{ $item->link }}" class="read-more" target="_blank">Baca selengkapnya</a>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    {{-- <a href="/berita" class="btn">LIHAT LEBIH BANYAK</a> --}}
    </section>


    <!-- Gallery Section -->
    <section class="gallery">
    <h2>GALERI KAMI</h2>
    <div class="galeri-grid-container">
        <div class="grid-container">
            @foreach ($galeri as $item)
                <div class="grid-item">
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">
                </div>
            @endforeach

        </div>
    </div>
    <a href="/galeri" class="btn">LIHAT LEBIH BANYAK</a>
    </section>
@endsection
