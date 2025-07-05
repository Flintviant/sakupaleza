<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WilayahController extends Controller
{
    public function getKelurahan(Request $request)
    {
        $id_kecamatan = $request->input('id_kecamatan');

        if (!$id_kecamatan) {
            return response()->json(['html' => '<option value="">ID Kecamatan tidak tersedia</option>']);
        }

        $kelurahans = DB::table('kelurahan')
            ->where('id_kecamatan', $id_kecamatan)
            ->get();

        if ($kelurahans->isEmpty()) {
            return response()->json(['html' => '<option value="">Tidak ada kelurahan</option>']);
        }

        $options = '<option value="">Pilih Kelurahan</option>';
        foreach ($kelurahans as $kelurahan) {
            $options .= '<option value="' . $kelurahan->id_kelurahan . '" data-jarak="' . $kelurahan->jarak . '">' . $kelurahan->nama_kelurahan . '</option>';
        }

        return response()->json(['html' => $options]);
    }

}
