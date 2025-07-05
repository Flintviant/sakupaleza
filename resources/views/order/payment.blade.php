@extends('layouts.app')
@section('title', 'Pembayaran')

@section('content')
<div class="container">
    <h2>Konfirmasi Pembayaran</h2>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item['nama'] }}</td>
                    <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                    <td>{{ $item['jumlah'] }}</td>
                    <td>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr><td colspan="3"><strong>Total</strong></td><td>Rp {{ number_format($total, 0, ',', '.') }}</td></tr>
            <tr><td colspan="3"><strong>Ongkir</strong></td><td>Rp {{ number_format($order['ongkir'], 0, ',', '.') }}</td></tr>
            <tr><td colspan="3"><strong>Grand Total</strong></td><td>Rp {{ number_format($grandTotal, 0, ',', '.') }}</td></tr>
        </tfoot>
    </table>

    <form method="POST" action="{{ route('order.payment.confirm') }}">
        @csrf
        <button type="submit" class="btn-order">Bayar Sekarang</button>
    </form>
</div>
@endsection
