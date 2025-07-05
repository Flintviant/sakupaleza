@extends('layouts.admin')

@section('title', 'Edit Kontak')

@section('content')
<h2>Edit Kontak</h2>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.kontak.update', $kontak->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $kontak->email) }}" required>
    </div>
    <div class="form-group">
        <label>Telepon</label>
        <input type="text" name="telepon" value="{{ old('telepon', $kontak->telepon) }}" required>
    </div>
    <div class="form-group">
        <label>Lokasi</label>
        <textarea name="lokasi" rows="5" required>{{ old('lokasi', $kontak->lokasi) }}</textarea>
    </div>
    <button type="submit">Update</button>
</form>
@endsection
