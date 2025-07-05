@extends('layouts.admin')

@section('title', 'Pesanan Masuk')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/pesananmasuk.css') }}">
@endpush

@section('content')
<h1>Pesanan Masuk</h1>
<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>No. Telepon</th>
            <th>Alamat</th>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Ongkir</th>
            <th>Grand Total</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($orders as $order)
        <tr>
            <td>{{ $order->nama_pemesan }}</td>
            <td>{{ $order->telepon }}</td>
            <td>{{ $order->alamat }}</td>
            <td>{{ $order->produk }}</td>
            <td>{{ $order->jumlah }}</td>
            <td>
                Rp {{ number_format($order->ongkir ?? 0, 0, ',', '.') }}
            </td>
            <td>
                @php
                    $grandTotal = ($order->total_harga ?? 0) + ($order->ongkir ?? 0);
                @endphp
                Rp {{ number_format($grandTotal, 0, ',', '.') }}
            </td>
            <td>{{ ucfirst($order->status) }}</td>
            <td>
                <a href="{{ route('admin.order.show', $order->id) }}">Detail</a>
                <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <select name="status" onchange="this.form.submit()">
                        <option value="">Ubah Status</option>
                        <option value="proses" @if($order->status === 'proses') selected @endif>Proses</option>
                        <option value="selesai" @if($order->status === 'selesai') selected @endif>Selesai</option>
                        <option value="dibatalkan" @if($order->status === 'dibatalkan') selected @endif>Dibatalkan</option>
                    </select>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9">Tidak ada pesanan.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
