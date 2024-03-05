<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 001,
                'kategori_kode' => 'A1',
                'kategori_nama' => 'Makanan',
            ],
            [
                'kategori_id' => 002,
                'kategori_kode' => 'B2',
                'kategori_nama' => 'Kecantikan',
            ],
            [
                'kategori_id' => 003,
                'kategori_kode' => 'C3',
                'kategori_nama' => 'Rumah_Tangga',
            ],
            [
                'kategori_id' => 004,
                'kategori_kode' => 'D4',
                'kategori_nama' => 'Bayi',
            ],
            [
                'kategori_id' => 005,
                'kategori_kode' => 'E4',
                'kategori_nama' => 'Perkakas',
            ],
        ];
        DB::table('m_kategori')->insert($data);
    }
}
