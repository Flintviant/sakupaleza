@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('content')
    <h1>Detail Pesanan</h1>

    <table>
        <tr>
            <th>Nama Pemesan</th>
            <td>{{ $order->nama_pemesan }}</td>
        </tr>
        <tr>
            <th>Telepon</th>
            <td>{{ $order->telepon }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $order->alamat }}</td>
        </tr>
        <tr>
            <th>Produk</th>
            <td>{{ $order->produk }}</td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td>{{ $order->jumlah }}</td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($order->status) }}</td>
        </tr>
    </table>

    <br>
    <a href="{{ route('admin.order.index') }}" class="btn">← Kembali ke daftar pesanan</a>
@endsection
