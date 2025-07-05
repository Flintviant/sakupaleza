<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
</head>
<body>
    <div class="sidebar">
        <h2>Admin</h2>
        <ul>
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.profile') }}">Profil Admin</a></li>
            <li class="dropdown" onclick="toggleDropdown(this)">
                <span>Kelola Konten ▾</span>
                <ul class="dropdown-content">
                    <li><a href="{{ route('admin.berita.index') }}">Kelola Berita</a></li>
                    <li><a href="{{ route('admin.galeri.index') }}">Kelola Galeri</a></li>
                    <li><a href="{{ route('admin.kontak.index') }}">Kelola Kontak</a></li>
                    <li><a href="{{ route('admin.menu.index') }}">Kelola Menu</a></li>

                </ul>
            </li>
            <li class="dropdown" onclick="toggleDropdown(this)">
                <span>Pemesanan ▾</span>
                <ul class="dropdown-content">
                    <li><a href="{{ route('admin.order.index') }}">Pemesanan Masuk</a></li>
                    <li><a href="{{ route('admin.order.history') }}">Riwayat Pemesanan</a></li>
                </ul>
            </li>
            <li><a href="{{ route('admin.order.report') }}">Laporan Penjualan</a></li>
            <li>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <div class="content">
        <div class="top-bar">
            <h3>Hi, ADMIN</h3>
        </div>
        @yield('content')
    </div>

    <script>
        function toggleDropdown(element) {
            element.classList.toggle('active');
        }
    </script>
</body>
</html>
