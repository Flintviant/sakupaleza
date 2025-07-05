@extends('layouts.admin')

@section('title', 'Kelola galeri')

@section('content')
<h2>Kelola galeri</h2>

<a href="{{ route('admin.galeri.create') }}">+ Tambah galeri</a>

@if (session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <tr>
        <th>gambar</th>
        <th>Aksi</th>
    </tr>
    @foreach ($galeri as $b)
        <tr>
            <td>
                @if($b->gambar)
                    <img src="{{ asset('storage/' . $b->gambar) }}" alt="Gambar" style="width:80px;height:auto;">
                @else
                    Tidak Ada
                @endif
            </td>            
            <td>
                <a href="{{ route('admin.galeri.edit', $b) }}">Edit</a>
                <form action="{{ route('admin.galeri.destroy', $b) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
@endsection
