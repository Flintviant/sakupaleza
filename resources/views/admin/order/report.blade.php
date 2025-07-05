@extends('layouts.admin')

@section('title', 'Laporan Penjualan')

@section('content')
<h1>Laporan Penjualan</h1>

<form method="GET" action="{{ route('admin.order.report') }}" style="margin-bottom:20px;">
    <label>
        Dari Tanggal:
        <input type="date" name="start_date" value="{{ request('start_date') }}">
    </label>
    <label>
        Sampai Tanggal:
        <input type="date" name="end_date" value="{{ request('end_date') }}">
    </label>
    <button type="submit">Filter</button>
</form>

<p><strong>Total Pendapatan:</strong> Rp {{ number_format($totalPenjualan,0,',','.') }}</p>

@forelse ($groupedOrders as $tanggal => $orders)
    <h3>Tanggal: {{ \Carbon\Carbon::parse($tanggal)->format('d-m-Y') }}</h3>
    <table style="margin-bottom: 20px;">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalHarian = 0;
            @endphp
            @foreach ($orders as $order)
            @php
                $totalHarian += $order->total_harga + ($order->ongkir ?? 0);
            @endphp
            <tr>
                <td>{{ $order->nama_pemesan }}</td>
                <td>{{ $order->produk }}</td>
                <td>{{ $order->jumlah }}</td>
                <td>Rp {{ number_format($order->total_harga + ($order->ongkir ?? 0),0,',','.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3"><strong>Total Tanggal Ini</strong></td>
                <td><strong>Rp {{ number_format($totalHarian,0,',','.') }}</strong></td>
            </tr>
        </tbody>
    </table>
@empty
    <p>Tidak ada data untuk rentang tanggal ini.</p>
@endforelse
@endsection
