@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
<h2>Edit Berita</h2>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.berita.update', $berita->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div>
        <label>Judul</label>
        <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" required>
    </div>
    <div>
        <label>Gambar (biarkan kosong jika tidak diganti)</label>
        <input type="file" name="gambar">
        <div style="margin-top:5px;">
            <img src="{{ asset('storage/'.$berita->gambar) }}" alt="Gambar Saat Ini" width="100">
        </div>
    </div>
    <div>
        <label>Konten</label>
        <textarea name="konten" rows="5" required>{{ old('konten', $berita->konten) }}</textarea>
    </div>
    <div>
        <label>Link</label>
        <input type="text" name="link" value="{{ old('link', $berita->link) }}">
    </div>
    <div>
        <button type="submit">Update</button>
    </div>
</form>

@endsection
