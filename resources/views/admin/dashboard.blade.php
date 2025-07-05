@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h2>Dashboard Admin</h2>

<div style="display: flex; gap: 20px; flex-wrap: wrap;">
    <div style="border:1px solid #ddd; padding:20px; width:200px;">
        <h3>Total Berita</h3>
        <p>{{ $totalBerita }}</p>
    </div>
    <div style="border:1px solid #ddd; padding:20px; width:200px;">
        <h3>Total Galeri</h3>
        <p>{{ $totalGaleri }}</p>
    </div>
    <div style="border:1px solid #ddd; padding:20px; width:200px;">
        <h3>Total Kontak</h3>
        <p>{{ $totalKontak }}</p>
    </div>
    <div style="border:1px solid #ddd; padding:20px; width:200px;">
        <h3>Total Pesanan</h3>
        <p>{{ $totalOrder }}</p>
    </div>
        <div style="border:1px solid #ddd; padding:20px; width:200px;">
        <h3>Total Menu</h3>
        <p>{{ $totalMenu }}</p>
    </div>
</div>
@endsection
