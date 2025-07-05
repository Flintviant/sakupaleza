<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Kontak;
use App\Models\Menu;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBerita = Berita::count();
        $totalGaleri = Galeri::count();
        $totalKontak = Kontak::count();
        $totalOrder = Order::count();
        $totalMenu = Menu::count();

        return view('admin.dashboard', compact(
            'totalBerita',
            'totalGaleri',
            'totalKontak',
            'totalOrder',
            'totalMenu'
        ));
    }
}
