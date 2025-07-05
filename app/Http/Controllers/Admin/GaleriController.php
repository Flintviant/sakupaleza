<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::latest()->get();
        return view('admin.galeri.index', compact('galeri'));
    }

    // Ini hanya jika kamu ingin galeri untuk halaman publik
    public function galeriLanding()
    {
        $galeri = Galeri::latest()->get();
        return view('galeri', compact('galeri'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'gambar' => 'required|image|max:2048',
    ]);

    $path = $request->file('gambar')->store('galeri', 'public');

    Galeri::create([
        'gambar' => $path,
    ]);

    return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil ditambahkan.');
}

    public function edit(galeri $galeri, $id)
    {
        $galeri = galeri::findOrFail($id);
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'gambar' => 'nullable|image|max:2048',
        ]);

        $galeri = Galeri::findOrFail($id);

        $data = [];

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('galeri', 'public');
            $data['gambar'] = $path;
        }

        if (!empty($data)) {
            $galeri->update($data);
        }

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
