@extends('layouts.admin')

@section('title', 'Daftar Berita')

@section('content')
<h2>Daftar Berita</h2>

<a href="{{ route('admin.berita.create') }}">+ Tambah Berita</a>

<table border="1" cellpadding="8" cellspacing="0" width="100%" style="margin-top: 10px;">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Gambar</th>
            <th>Konten</th>
            <th>Link</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($beritas as $berita)
        <tr>
            <td>{{ $berita->judul }}</td>
            <td>
                @if($berita->gambar)
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar" style="width:80px;height:auto;">
                @else
                    Tidak Ada
                @endif
            </td>
            <td>{{ $berita->konten }}</td>
            <td><a href="{{ $berita->link }}" target="_blank">Lihat</a></td>
            <td>
                <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn-aksi">Edit</a>
                <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="btn-aksi btn-hapus">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">Belum ada data berita.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
