@extends('layouts.app')

@section('title', 'Tentang')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
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
        </div>
    </header>
            <section class="about-us">
            <div class="about-us-content">
                <h2>SEJARAH</h2>
                <h3>Bermula pada tahun 2021, Heni indriyani selaku Kepala usaha kerap mengikuti kelas atau seminar kewirausahaan yang digelar oleh Pemerintah Kota Depok. Dengan segala bekal yang dimiliki, tahun 2022 Heni indriyani mulai bergerak untuk memperjual-belikan makanan dan minuman yang dihasilkan oleh berbagai relasi UMKM. Pada bulan Juni tahun 2024 Heni indriyani selaku Kepala usaha mulai membuka Kedai rumahan yang bertepat di Jalan Pulo Jaya. Dibantu dengan Konsisten kedai itu berdiri dan konsumen yang mulai mengenal produk penjualan Heni, maka diresmikan lah pada Oktober 2024 dengan nama “Sakupaleza” yang memiliki arti singkatan dari “Sarana Kumpul Pulo Jaya”. Kata “Saku” bermakna sebuah saku atau harga yang ramah dikantong.</h3>
                <p>Dimsum menjadi menu utama kedai Sakupaleza yang kini dikenal dengan “Dimsum Sakupaleza” yang bertepat di Jalan Raya Melati, Beji Kota Depok. Dengan aktifnya Dimsum Sakupaleza mengikuti bazzar dan Event mingguan di lokasi Taman Lembah Mawar, Kota Depok. Cabang ke dua berhasil didirikan di bulan Desember 2024 yang bertepat di Taman Lembah Gurame, Kota Depok.</p>
                <p>Bertepat tanggal 17 April 2025. Sakupaleza mendapat Sertifikat Halal Republik Indonesia.</p>
            </div>
            {{-- <div class="image">
                <img src="{{ asset('image/brooke-lark-oaz0raysASk-unsplash.jpg') }}" alt="Food Image 1">
                <img src="{{ asset('image/sebastian-coman-photography-eBmyH7oO5wY-unsplash.jpg') }}" alt="Food Image 2">
            </div> --}}
        </div>
    </section>
    <section class="vision-mission">
    <div class="container">
        <div class="card-wrapper">
            <div class="card">
                <div class="card-content">
                    <h3>VISI</h3>
                    <p>Menjadi perusahaan makanan ringan terbaik yang berkualitas dan termurah di Indonesia.</p>
                </div>
            </div>

            <div class="card">
                <div class="card-content">
                    <h3>MISI</h3>
                    <p>1. Membuat makanan ringan dengan cita rasa yang dapat diterima berbagai kalangan.</p>
                    <p>2. Menyajikan aneka makanan ringan berkualitas dengan harga yang terjangkau.</p> 
                    <p>3. Melakukan inovasi dan membantu memajukan UMKM untuk melakukan penjualan di satu titik.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
