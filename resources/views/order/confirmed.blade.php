@extends('layouts.app')

@section('title', 'Pesanan Dikonfirmasi')

@push('styles')
<style>
    .confirmed-wrapper {
        max-width: 600px;
        margin: 50px auto;
        padding: 30px;
        background: #f9f9f9;
        border-radius: 20px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        text-align: center;
    }
    .confirmed-wrapper h2 {
        color: #28a745;
        margin-bottom: 20px;
    }
    .order-info p {
        font-size: 16px;
        margin: 10px 0;
    }
    .status {
        font-weight: bold;
        color: #007bff;
    }
    .btn-dashboard {
        margin-top: 25px;
        background: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        transition: background 0.3s;
        text-decoration: none;
        display: inline-block;
    }
    .btn-dashboard:hover {
        background: #0056b3;
    }
</style>
@endpush

@section('content')
<div class="confirmed-wrapper">
    <h2>✅ Pesanan Kamu Berhasil Dikonfirmasi!</h2>

    <div class="order-info">
        <p>📦 <strong>Nomor Pesanan:</strong> #{{ $order->id }}</p>
        <p>👤 <strong>Nama Pemesan:</strong> {{ $order->nama_pemesan }}</p>
        <p>📞 <strong>Telepon:</strong> {{ $order->telepon }}</p>
        <p>📍 <strong>Alamat Pengiriman:</strong> {{ $order->alamat }}</p>
        <p>💵 <strong>Total Pembayaran:</strong> Rp {{ number_format($order->total_harga + $order->ongkir, 0, ',', '.') }}</p>
        <p>🚚 <strong>Status:</strong> <span class="status">{{ ucfirst($order->status) }}</span></p>
    </div>

    <a href="{{ route('member.dashboard') }}" class="btn-dashboard">🔙 Kembali ke Dashboard</a>
</div>
@endsection
