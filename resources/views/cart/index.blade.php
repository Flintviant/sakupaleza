@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="container">
    <h2>Keranjang Belanja</h2>

    @if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(count($cart))
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($cart as $item)
            @php $subtotal = $item['harga'] * $item['jumlah']; $total += $subtotal; @endphp
            <tr>
                <td>{{ $item['nama'] }}</td>
                <td>Rp {{ number_format($item['harga'],0,',','.') }}</td>
                <td>{{ $item['jumlah'] }}</td>
                <td>Rp {{ number_format($subtotal,0,',','.') }}</td>
                @if(isset($item['id']))
<form action="{{ route('cart.remove', $item['id']) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit">Hapus</button>
</form>
@endif

            </tr>
            @endforeach
        </tbody>
    </table>
    <h4>Total: Rp {{ number_format($total,0,',','.') }}</h4>
    <form action="{{ route('cart.clear') }}" method="POST">
        @csrf
        <button type="submit">Kosongkan Keranjang</button>
    </form>
    <a href="{{ route('order.create') }}"><button>Checkout</button></a>
    @else
    <p>Keranjang kosong.</p>
    @endif
</div>
@endsection
