@extends('layouts.admin')

@section('title', 'Edit Menu')

@section('content')
<h1>Edit Menu</h1>
<form action="{{ route('admin.menu.update', $menu) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="text" name="nama" value="{{ $menu->nama }}" required>
    <textarea name="deskripsi">{{ $menu->deskripsi }}</textarea>
    <input type="number" name="harga" value="{{ $menu->harga }}" required>
    @if($menu->gambar)
        <img src="{{ asset('storage/'.$menu->gambar) }}" width="100">
    @endif
    <input type="file" name="gambar">
    <button type="submit">Update</button>
</form>
@endsection
