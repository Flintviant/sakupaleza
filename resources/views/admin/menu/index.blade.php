@extends('layouts.admin')

@section('title', 'Kelola Menu')

@section('content')
<h1>Kelola Menu</h1>
<a href="{{ route('admin.menu.create') }}">+ Tambah Menu</a>
<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($menus as $menu)
        <tr>
            <td>{{ $menu->nama }}</td>
            <td>Rp {{ number_format($menu->harga,0,',','.') }}</td>
            <td>
                @if($menu->gambar)
                <img src="{{ asset('storage/'.$menu->gambar) }}" width="50">
                @endif
            </td>
            <td>
                <a href="{{ route('admin.menu.edit', $menu) }}">Edit</a>
                <form action="{{ route('admin.menu.destroy', $menu) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Hapus menu ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
