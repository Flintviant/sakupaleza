<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $kontak = Kontak::latest()->get();
        return view('admin.kontak.index', compact('kontak'));
    }

    public function kontakLanding()
    {
        $kontaks = Kontak::latest()->get();
        return view('kontak', compact('kontaks'));
    }

    public function create()
    {
        return view('admin.kontak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'telepon' => 'required',
            'lokasi' => 'required',
        ]);

        Kontak::create([
            'email' => $request->email,
            'telepon' => $request->telepon,
            'lokasi' => $request->lokasi,
        ]);

        return redirect()->route('admin.kontak.index')->with('success', 'Kontak berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kontak = Kontak::findOrFail($id);
        return view('admin.kontak.edit', compact('kontak'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'telepon' => 'required',
            'lokasi' => 'required',
        ]);

        $kontak = Kontak::findOrFail($id);

        $kontak->update([
            'email' => $request->email,
            'telepon' => $request->telepon,
            'lokasi' => $request->lokasi,
        ]);

        return redirect()->route('admin.kontak.index')->with('success', 'Kontak berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kontak = Kontak::findOrFail($id);
        $kontak->delete();

        return redirect()->route('admin.kontak.index')->with('success', 'Kontak berhasil dihapus.');
    }
}

