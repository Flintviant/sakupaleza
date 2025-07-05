@extends('layouts.app')

@section('title', 'Kontak')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/kontak.css') }}">
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
            </nav>
    </header>
{{-- Form Kontak --}}
<section class="contact-section">
    <form class="contact-form" method="POST" action="#">
        @csrf
        <input type="text" name="subject" placeholder="Subject" required>
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <textarea name="message" placeholder="Message" required></textarea>
        <button type="submit">KIRIM</button>
    </form>
</section>

{{-- Info Kontak --}}
<section class="contact-info">
    @foreach($kontaks as $kontak)
        <div class="info-item">
            <img src="{{ asset('image/Group 66.png') }}" alt="Email Icon">
            <p><strong>Email</strong><br>{{ $kontak->email }}</p>
        </div>
        <div class="info-item">
            <img src="{{ asset('image/Group 67.png') }}" alt="Phone Icon">
            <p><strong>Phone</strong><br>{{ $kontak->telepon }}</p>
        </div>
        <div class="info-item">
            <img src="{{ asset('image/Group 68.png') }}" alt="Location Icon">
            <p><strong>Location</strong><br>{{ $kontak->lokasi }}</p>
        </div>
    @endforeach
</section>

{{-- Map --}}
<section id="maps" class="map-section">
    <div class="mb-5">
        @foreach ($kontaks as $kontak)
            @if($kontak->lokasi)
                <div id="map-container" data-location="{{ $kontak->lokasi }}">
                    <iframe 
                        id="mapFrame" 
                        style="width: 100%; height: 400px;" 
                        src="https://www.google.com/maps?q={{ urlencode($kontak->lokasi) }}&output=embed" 
                        frameborder="0" 
                        allowfullscreen>
                    </iframe>
                </div>
            @endif
        @endforeach
    </div>
</section>

@endsection
