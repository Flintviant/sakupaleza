@extends('layouts.admin')

@section('title', 'Kelola kontak')

@section('content')
<h2>Kelola kontak</h2>

<a href="{{ route('admin.kontak.create') }}">+ Tambah kontak</a>

@if (session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <tr>
        <th>Email</th>
        <th>Telepon</th>
        <th>Lokasi</th>
        <th>Aksi</th>
    </tr>
    @foreach ($kontak as $b)
        <tr>
            <td>{{ $b->email }}</td>
            <td>{{ $b->telepon }}</td>
            <td>{{ $b->lokasi }}</td>

            <td>
                <a href="{{ route('admin.kontak.edit', $b) }}">Edit</a>
                <form action="{{ route('admin.kontak.destroy', $b) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
@endsection
