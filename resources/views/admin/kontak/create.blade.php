@extends('layouts.admin')

@section('title', 'Tambah Kontak')

@section('content')
<h2>Tambah Kontak</h2>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.kontak.store') }}">
    @csrf
    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
    </div>
    <div>
        <label>Telepon</label>
        <input type="text" name="telepon" value="{{ old('telepon') }}" required>
    </div>
    <div>
        <label>Lokasi</label>
        <input type="text" name="lokasi" value="{{ old('lokasi') }}" required>
    </div>
    <button type="submit">Simpan</button>
</form>
@endsection
