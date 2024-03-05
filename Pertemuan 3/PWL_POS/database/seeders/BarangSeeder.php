<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_id' => 111,
                'kategori_id' => 001,
                'barang_kode' => 'A111',
                'barang_nama' => 'Chitato',
                'harga_beli' => 7000,
                'harga_jual' => 10000,
            ],
            [
                'barang_id' => 112,
                'kategori_id' => 001,
                'barang_kode' => 'B112',
                'barang_nama' => 'Taro',
                'harga_beli' => 8000,
                'harga_jual' => 11000,
            ],
            [
                'barang_id' => 221,
                'kategori_id' => 002,
                'barang_kode' => 'A221',
                'barang_nama' => 'Wardah_Lipcream',
                'harga_beli' => 50000,
                'harga_jual' => 57000,
            ],
            [
                'barang_id' => 222,
                'kategori_id' => 002,
                'barang_kode' => 'B222',
                'barang_nama' => 'Facetology_Sunscreen',
                'harga_beli' => 72000,
                'harga_jual' => 80000,
            ],
            [
                'barang_id' => 331,
                'kategori_id' => 003,
                'barang_kode' => 'A331',
                'barang_nama' => 'Sapu_Lantai',
                'harga_beli' => 43000,
                'harga_jual' => 51000,
            ],
            [
                'barang_id' => 332,
                'kategori_id' => 003,
                'barang_kode' => 'B332',
                'barang_nama' => 'Pel_Lantai',
                'harga_beli' => 83000,
                'harga_jual' => 95000,
            ],
            [
                'barang_id' => 441,
                'kategori_id' => 004,
                'barang_kode' => 'A441',
                'barang_nama' => 'Pampers',
                'harga_beli' => 43000,
                'harga_jual' => 53000,
            ],
            [
                'barang_id' => 442,
                'kategori_id' => 004,
                'barang_kode' => 'B441',
                'barang_nama' => 'Sabun_bayi',
                'harga_beli' => 35000,
                'harga_jual' => 43000,
            ],
            [
                'barang_id' => 551,
                'kategori_id' => 005,
                'barang_kode' => 'A551',
                'barang_nama' => 'Palu',
                'harga_beli' => 27000,
                'harga_jual' => 36000,
            ],
            [
                'barang_id' => 552,
                'kategori_id' => 005,
                'barang_kode' => 'B552',
                'barang_nama' => 'Obeng',
                'harga_beli' => 14000,
                'harga_jual' => 21000,
            ],
        ];
        DB::table('m_barang')->insert($data);
    }
}
