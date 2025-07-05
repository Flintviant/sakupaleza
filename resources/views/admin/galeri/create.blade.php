@extends('layouts.admin')

@section('title', 'Tambah galeri')

@section('content')
<h2>Tambah galeri</h2>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="gambar" required>
    <button type="submit">Simpan</button>
</form>

@endsection
