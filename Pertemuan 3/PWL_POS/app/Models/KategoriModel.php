<?php

namespace App\Models;

use App\Model\BarangModel;
use App\Models\barangModel as ModelsBarangModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriModel extends Model {
    use HasFactory;
    protected $table = 'm_kategori';
    protected $primaryKey = 'kategori_id';

    protected $fillable = ['kategori_kode', 'kategori_nama'];

    public function barang(): HasMany{
        return $this->hasMany(ModelsBarangModel::class, 'kategori_id', 'kategori_id');
    }
}