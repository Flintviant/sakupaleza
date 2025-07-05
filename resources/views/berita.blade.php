@extends('layouts.app')

@section('title', 'Berita')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/berita.css') }}">
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
    </header>
{{-- Highlight News --}}
<section class="highlight-news">
    <img src="{{ asset('image/sakupaleza-1.jpg') }}" alt="Berita Utama">
    <div class="highlight-text">
        <h2>APA SAJA MAKANAN KHAS NUSANTARA?</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare...</p>
        <a href="#" class="button">BACA SELENGKAPNYA</a>
    </div>
</section>

<section class="berita-grid">
    <h3>BERITA LAINNYA</h3>
    <div class="grid">
        @forelse ($berita as $berita)
        <div class="card">
            @if($berita->gambar)
                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}">
            @else
                <img src="{{ asset('image/default.jpg') }}" alt="No Image">
            @endif
            <div class="card-body">
                <h4>{{ $berita->judul }}</h4>
                <p>{{ Str::limit(strip_tags($berita->konten), 100) }}</p>
                @if($berita->link)
                    <a href="{{ $berita->link }}" class="read-more" target="_blank">Baca selengkapnya</a>
                @endif
            </div>
        </div>
        @empty
        <p>Tidak ada berita.</p>
        @endforelse
    </div>
</section>
{{-- Grid Berita Lainnya --}}
{{-- <section class="berita-grid">
    <h3>BERITA LAINNYA</h3>
    <div class="grid">
        @for ($i = 1; $i <= 6; $i++)
        <div class="card">
            <img src="{{ asset("image/sakupaleza-$i.jpg") }}" alt="Berita {{ $i }}">
            <div class="card-body">
                <h4>LOREM IPSUM</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <a href="https://www.instagram.com/reel/DKHavDSPnzF/?igsh=MXNpaHBoeWp2dmloZw==" class="read-more">Baca selengkapnya</a>
            </div>
        </div>
        @endfor
    </div>
</section> --}}
@endsection