<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('admin.berita.index', compact('beritas'));
    }

    public function BeritaLanding(){
        $berita = Berita::all();
        return view('berita', compact('berita'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
    $request->validate([
        'judul' => 'required',
        'konten' => 'required',
        'link' => 'nullable|url',
        'gambar' => 'required|image|max:2048', // validasi file gambar
    ]);

    // upload file
    $path = $request->file('gambar')->store('berita', 'public');

    Berita::create([
        'judul' => $request->judul,
        'konten' => $request->konten,
        'link' => $request->link,
        'gambar' => $path,
    ]);

    return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }


    public function edit(Berita $berita, $id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'gambar' => 'nullable|image|max:2048',
            'konten' => 'required',
            'link' => 'nullable|url',
        ]);

        $berita = Berita::findOrFail($id);

        $data = $request->only('judul', 'konten', 'link');

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('berita', 'public');
            $data['gambar'] = $path;
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
