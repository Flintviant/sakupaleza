<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Galeri;

class HomeController extends Controller
{
public function index()
    {
        $galeri = Galeri::take(6)->get(); // Ambil 6 item dari galeri
        $berita = Berita::take(3)->get(); // Ambil 5 item dari berita
    
        return view('index', compact('galeri', 'berita'));

    }
}
