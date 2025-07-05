<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('member_id', Auth::guard('member')->id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('order.index', compact('orders'));
    }

    public function create()
    {
        $cart = session('cart', []);
        return view('order.create', compact('cart'));
    }

    public function store(Request $request)
    {
        $data = session('order_preview');
        if (!$data) {
            return redirect()->route('order.create')->with('error', 'Data pesanan tidak ditemukan.');
        }

        $request->validate([
            'menu' => 'required|array',
            'harga' => 'required|array',
            'jumlah' => 'required|array',
            'nama_pemesan' => 'required|string',
            'telepon' => 'required|string',
            'alamat' => 'required|string',
            'kelurahan' => 'required|exists:kelurahan,id_kelurahan',
            'kecamatan' => 'required|exists:kecamatan,id_kecamatan',
        ]);

        // Ambil kelurahan
        $kecamatan = DB::table('kecamatan')->where('id_kecamatan', $request->kecamatan)->first();
        if (!$kecamatan) {
            return back()->withErrors(['kecamatan' => 'Data kecamatan tidak ditemukan.']);
        }

        // Ambil kelurahan
        $kelurahan = DB::table('kelurahan')->where('id_kelurahan', $request->kelurahan)->first();
        if (!$kelurahan) {
            return back()->withErrors(['kelurahan' => 'Data kelurahan tidak ditemukan.']);
        }

        // Hitung ongkir
        $tarifPerKm = 1000;
        $ongkir = $kelurahan->jarak * $tarifPerKm;

        $produk = [];
        $totalHarga = 0;
        $totalQty = 0;

        foreach ($data['menu'] as $i => $menu) {
            $harga = $data['harga'][$i];
            $jumlah = $data['jumlah'][$i];
            $produk[] = "{$menu} x {$jumlah}";
            $totalHarga += $harga * $jumlah;
            $totalQty += $jumlah;
        }

        // Simpan ke orders
        Order::create([
            'member_id' => Auth::guard('member')->id(),
            'nama_pemesan' => $data['nama_pemesan'],
            'telepon' => $data['telepon'],
            'alamat' => $data['alamat'],
            'id_kelurahan' => $data['kelurahan'],
            'id_kecamatan' => $data['kecamatan'],
            'produk' => implode(', ', $produk),
            'jumlah' => $totalQty,
            'total_harga' => $totalHarga,
            'ongkir' => $ongkir,
            'status' => 'pending',
        ]);

        session()->forget('order_preview');
        session()->forget('cart');

        return redirect()->route('order.create')->with('success', 'Pesanan berhasil dikirim!');
    }

    public function history()
    {
        $orders = Order::where('member_id', Auth::guard('member')->id())->latest()->get();
        return view('member.dashboard', compact('orders'));
    }

    public function previewPayment(Request $request) {

        $request->validate([
            'menu' => 'required|array',
            'harga' => 'required|array',
            'jumlah' => 'required|array',
            'nama_pemesan' => 'required|string',
            'telepon' => 'required|string',
            'kelurahan' => 'required|exists:kelurahan,id_kelurahan',
            'ongkir' => 'required|numeric|min:0',
        ]);

        session([
            'order_preview' => $request->all()
        ]);

        return redirect()->route('order.payment.page');
    }

    public function payment(Order $order)
    {
        return view('order.payment', compact('order'));
    }

    public function paymentPage()
    {
        $order = session('order_preview');

        if (!$order) {
            return redirect()->route('order.create')->with('error', 'Data pesanan tidak ditemukan.');
        }

        // Hitung ulang total
        $items = [];
        $total = 0;
        foreach ($order['menu'] as $i => $nama) {
            $harga = $order['harga'][$i];
            $jumlah = $order['jumlah'][$i];
            $subtotal = $harga * $jumlah;
            $total += $subtotal;

            $items[] = [
                'nama' => $nama,
                'harga' => $harga,
                'jumlah' => $jumlah,
                'subtotal' => $subtotal
            ];
        }

        $grandTotal = $total + $order['ongkir'];

        return view('order.payment', compact('order', 'items', 'total', 'grandTotal'));
    }

}
