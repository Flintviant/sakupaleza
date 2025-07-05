@extends('layouts.admin')

@section('title', 'Edit galeri')

@section('content')
<h2>Edit galeri</h2>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.galeri.update', $galeri->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div>
        <label>Gambar (biarkan kosong jika tidak diganti)</label>
        <input type="file" name="gambar">
        <div style="margin-top:5px;">
            <img src="{{ asset('storage/'.$galeri->gambar) }}" alt="Gambar Saat Ini" width="100">
        </div>
    </div>
        <button type="submit">Update</button>
    </div>
</form>

@endsection
