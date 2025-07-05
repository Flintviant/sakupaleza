<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'nama_pemesan',
        'telepon',
        'id_kelurahan',
        'id_kecamatan',
        'alamat',
        'produk',
        'jumlah',
        'total_harga',
        'ongkir',
        'status'
    ];

    /**
     * Jika ada relasi ke member
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
