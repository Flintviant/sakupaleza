@extends('layouts.admin')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="container">
    <h1>Riwayat Pesanan</h1>

    <form method="GET" action="{{ route('admin.order.history') }}" style="margin-bottom:20px;">
        <label>
            Filter Status:
            <select name="status" onchange="this.form.submit()">
                <option value="">-- Semua Status --</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </label>
    </form>

    <table>
        <thead>
            <tr>
                <th>Nama Pemesan</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Tanggal Update</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $order->nama_pemesan }}</td>
                <td>{{ $order->produk }}</td>
                <td>{{ $order->jumlah }}</td>
                <td>Rp {{ number_format($order->total_harga,0,',','.') }}</td>
                <td>{{ ucfirst($order->status) }}</td>
                <td>{{ $order->updated_at->format('d-m-Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Tidak ada pesanan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('admin.order.index') }}" class="btn">← Kembali</a>
</div>
@endsection
