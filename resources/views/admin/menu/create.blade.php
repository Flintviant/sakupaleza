@extends('layouts.admin')

@section('title', 'Tambah Menu')

@section('content')
<h1>Tambah Menu</h1>
<form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="nama" placeholder="Nama Menu" required>
    <textarea name="deskripsi" placeholder="Deskripsi"></textarea>
    <input type="number" name="harga" placeholder="Harga" required>
    <input type="file" name="gambar">
    <button type="submit">Simpan</button>
</form>
@endsection
