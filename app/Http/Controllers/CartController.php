<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
{
    $menu = Menu::findOrFail($request->menu_id);

    $cart = session()->get('cart', []);

    // Cari apakah produk sudah ada
    $index = collect($cart)->search(function($item) use($menu) {
        return is_array($item) && isset($item['id']) && $item['id'] === $menu->id;
    });

    if ($index !== false) {
        // Jika sudah ada, tambah jumlah
        $cart[$index]['jumlah'] += $request->jumlah;
    } else {
        // Jika belum, tambahkan produk baru
        $cart[] = [
            'id' => $menu->id,
            'nama' => $menu->nama,
            'harga' => $menu->harga,
            'jumlah' => $request->jumlah,
        ];
    }

    session()->put('cart', $cart);

    return redirect()->route('order.create')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
}


    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang.');
    }
public function checkout(Request $request)
{
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
    }

    $request->validate([
        'nama_pemesan' => 'required|string',
        'telepon' => 'required|string',
        'alamat' => 'required|string',
    ]);

    // Gabungkan produk + jumlah
    $produk = [];
    $totalHarga = 0;
    $totalQty = 0;

    foreach ($cart as $item) {
        $produk[] = "{$item['nama']} x {$item['jumlah']}";
        $totalHarga += $item['harga'] * $item['jumlah'];
        $totalQty += $item['jumlah'];
    }

    // Simpan order
    $order = \App\Models\Order::create([
        'member_id' => auth('member')->check() ? auth('member')->id() : null,
        'nama_pemesan' => $request->nama_pemesan,
        'telepon' => $request->telepon,
        'alamat' => $request->alamat,
        'produk' => implode(', ', $produk),
        'jumlah' => $totalQty,
        'total_harga' => $totalHarga,
        'status' => 'pending',
    ]);

    // Kosongkan keranjang
    session()->forget('cart');

    return redirect()->route('order.index')->with('success', 'Pesanan berhasil dibuat!');
}


    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Keranjang dikosongkan.');
    }
}
