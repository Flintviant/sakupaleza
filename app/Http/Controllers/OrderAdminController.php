<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', 'pending')->orderBy('created_at', 'desc')->get();
        return view('admin.order.index', compact('orders'));
    }

    public function history(Request $request)
{
    $query = Order::query();

    // Jika ada filter status
    if ($request->has('status') && $request->status != '') {
        $query->where('status', $request->status);
    }

    $orders = $query->orderBy('updated_at', 'desc')->get();

    return view('admin.order.history', compact('orders'));
}


    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    public function create()
    {
        return view('admin.order.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
            'produk' => 'required',
            'jumlah' => 'required|integer|min:1',
            'bukti_pembayaran' => 'required',
            'total_harga' => 'required|numeric',
        ]);

        Order::create([
            'nama_pemesan' => $request->nama_pemesan,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'produk' => $request->produk,
            'jumlah' => $request->jumlah,
            'bukti_pembayaran' => $request->bukti_pembayaran,
            'total_harga' => $request->total_harga,
            'status' => 'pending',
        ]);

        return redirect()->route('admin.order.index')->with('success', 'Pesanan berhasil dibuat.');
    }
public function report(Request $request)
{
    // Ambil semua order yang status-nya "selesai"
     $startDate = $request->start_date;
    $endDate = $request->end_date;

    // Query orders yang statusnya selesai
    $query = Order::where('status', 'selesai');

    // Kalau ada filter tanggal, tambahkan whereBetween
    if ($startDate && $endDate) {
        $query->whereBetween('updated_at', [
            $startDate . ' 00:00:00',
            $endDate . ' 23:59:59'
        ]);
    }

    $orders = $query->get();

    // Hitung total semua pendapatan
    $totalPenjualan = $orders->sum(function ($order) {
        return $order->total_harga + ($order->ongkir ?? 0);
    });

    // Kelompokkan per tanggal
    $groupedOrders = $orders->groupBy(function ($order) {
        return $order->updated_at->format('Y-m-d');
    });

    return view('admin.order.report', compact('groupedOrders', 'totalPenjualan'));
}
public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required',
    ]);

    $order = Order::findOrFail($id);
    $order->status = $request->status;
    $order->save();

    return redirect()->route('admin.order.index')->with('success', 'Status pesanan diperbarui.');
}

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.order.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
