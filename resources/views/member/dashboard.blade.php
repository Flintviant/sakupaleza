@extends('layouts.app')

@section('title', 'Member Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/member.css') }}">
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
<div class="member-container">
    <div class="member-header">
        <h1>Dashboard Member</h1>
        <p>Halo, <strong>{{ Auth::guard('member')->user()->name }}</strong></p>
    </div>

    <div class="member-info">
        <h3>Profil Member</h3>
        <div><strong>Email:</strong> {{ Auth::guard('member')->user()->email }}</div>
        <div><strong>Nomor Telepon:</strong> {{ Auth::guard('member')->user()->phone ?? '-' }}</div>
        <div><strong>Bergabung Sejak:</strong> {{ Auth::guard('member')->user()->created_at->format('d M Y') }}</div>
    </div>

    <hr>

    <div class="member-orders">
        <h3>Riwayat Pemesanan</h3>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($orders->count())
        <table class="order-table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Produk</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                    <td>{{ $order->produk }}</td>
                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <p>Belum ada pesanan.</p>
        @endif
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn-logout">Logout</button>
    </form>
</div>
@endsection