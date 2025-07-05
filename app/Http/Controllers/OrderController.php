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
        if (!session()->has('order_preview')) {
            return redirect()->route('order.create')->with('error', 'Session pemesanan tidak ditemukan.');
        }

        $data = session('order_preview');
        $request->validate([
            'metode_pembayaran' => 'required|in:bca,ovo,gopay,shopeepay,qris',
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $bukti = $request->file('bukti_pembayaran')->store('bukti-pembayaran', 'public');

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
            $totalHarga += $harga * $jumlah + $ongkir;
            $totalQty += $jumlah;
        }

        if (!isset($data['menu'], $data['harga'], $data['jumlah'], $data['nama_pemesan'], $data['telepon'], $data['kelurahan'], $data['kecamatan'], $data['alamat'])) {
                return redirect()->route('order.create')->with('error', 'Data pemesanan tidak lengkap.');
            }

        // Simpan ke orders
        $order = Order::create([
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
            'status' => 'dibayar',
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_pembayaran' => $bukti,
        ]);


        // ✅ Hapus session agar tidak kembali ke payment
        session()->forget(['order_preview', 'cart', 'payment_deadline']);

        return redirect()->route('order.confirmed', ['id' => $order->id]);
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
            'kecamatan' => 'required|exists:kecamatan,id_kecamatan',
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
        // Cek dulu: ada session order atau tidak?
        if (!session()->has('order_preview')) {
            return redirect()->route('order.create')->with('error', 'Data pembayaran tidak ditemukan.');
        }

        // Ambil datanya setelah dipastikan ada
        $order = session('order_preview');

        // Timer batas pembayaran: 15 menit dari awal (bukan dari sekarang terus)
        if (!session()->has('payment_deadline')) {
            session(['payment_deadline' => now()->addMinutes(15)->timestamp]);
        }

        $deadline = session('payment_deadline');
        $remaining = $deadline - now()->timestamp;

        if ($remaining <= 0) {
            session()->forget(['payment_deadline', 'order_preview', 'cart']);
            return redirect()->route('order.create')->with('error', 'Waktu pembayaran telah habis.');
        }

        // Lanjut render view
        $items = [];
        $total = 0;
        foreach ($order['menu'] as $i => $nama) {
            $harga = $order['harga'][$i];
            $jumlah = $order['jumlah'][$i];
            $subtotal = $harga * $jumlah;
            $total += $subtotal;
            $items[] = compact('nama', 'harga', 'jumlah', 'subtotal');
        }

        $grandTotal = $total + $order['ongkir'];

        return view('order.payment', compact('order', 'items', 'total', 'grandTotal', 'remaining'));
    }


    public function confirmed($id)
    {
        $order = Order::findOrFail($id);

        // Pastikan user adalah pemilik pesanan
        if ($order->member_id !== Auth::guard('member')->id()) {
            abort(403);
        }

        return view('order.confirmed', compact('order'));
    }

    public function confirmPayment(Request $request)
    {
        if (!session()->has('order_preview')) {
            return redirect()->route('order.create')->with('error', 'Session pemesanan tidak ditemukan.');
        }

        $data = session('order_preview');

        // ✅ Validasi input
        $request->validate([
            'metode_pembayaran' => 'required|in:bca,ovo,gopay,shopeepay,qris',
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ✅ Simpan bukti pembayaran
        $bukti = $request->file('bukti_pembayaran')->store('bukti-pembayaran', 'public');

        // ✅ Validasi kelurahan dan kecamatan
        $kecamatan = DB::table('kecamatan')->where('id_kecamatan', $data['kecamatan'])->first();
        if (!$kecamatan) {
            return back()->withErrors(['kecamatan' => 'Data kecamatan tidak ditemukan.']);
        }

        $kelurahan = DB::table('kelurahan')->where('id_kelurahan', $data['kelurahan'])->first();
        if (!$kelurahan) {
            return back()->withErrors(['kelurahan' => 'Data kelurahan tidak ditemukan.']);
        }

        // ✅ Hitung ongkir berdasarkan jarak
        $tarifPerKm = 1000;
        $ongkir = $kelurahan->jarak * $tarifPerKm;

        // ✅ Hitung produk
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

        // ✅ Tambahkan ongkir ke total bayar
        $grandTotal = $totalHarga + $ongkir;

        // ✅ Simpan order ke DB
        $order = Order::create([
            'member_id'         => Auth::guard('member')->id(),
            'nama_pemesan'      => $data['nama_pemesan'],
            'telepon'           => $data['telepon'],
            'alamat'            => $data['alamat'],
            'id_kelurahan'      => $data['kelurahan'],
            'id_kecamatan'      => $data['kecamatan'],
            'produk'            => implode(', ', $produk),
            'jumlah'            => $totalQty,
            'total_harga'       => $grandTotal,
            'ongkir'            => $ongkir,
            'status'            => 'pending',
            'metode_pembayaran' => $request->metode_pembayaran, // ✅ INI WAJIB DIISI
            'bukti_pembayaran'  => $bukti,
        ]);

        // ✅ Bersihkan session
        session()->forget(['order_preview', 'cart', 'payment_deadline']);

        return redirect()->route('order.confirmed', ['id' => $order->id]);
    }


}
