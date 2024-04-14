<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class penjualanDetailModel extends Model
{
    use HasFactory;

    protected $table = 't_penjualan_detail';        // Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'detail_id';  // Mendefinisikan primary key dari tabel yang digunakan
    protected $fillable = [ 'penjualan_id', 'barang_id','harga','jumlah'];

    public function riwayat(): BelongsTo
    {
        return $this->belongsTo(riwayatModel::class, 'penjualan_id', 'penjualan_id');
    }
    public function barang(): BelongsTo
    {
        return $this->belongsTo(barangModel::class, 'barang_id', 'barang_id');
    }
}
