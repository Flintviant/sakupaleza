@extends('layouts.admin')

@section('title', 'Tambah Berita')

{{-- @push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
@endpush --}}

@section('content')
<h2>Tambah Berita</h2>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="text" name="judul" placeholder="Judul" required>
    <input type="file" name="gambar" required>
    <textarea name="konten" placeholder="Konten" required></textarea>
    <input type="text" name="link" placeholder="Link (opsional)">
    <button type="submit">Simpan</button>
</form>

@endsection
