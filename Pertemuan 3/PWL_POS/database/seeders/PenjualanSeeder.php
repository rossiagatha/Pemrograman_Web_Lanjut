<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => 1,
                'user_id' => 3,
                'pembeli' => 'Sara',
                'penjualan_kode' => 'A0001',
                'penjualan_tanggal' => '2024-2-15',
            ],
            [
                'penjualan_id' => 2,
                'user_id' => 3,
                'pembeli' => 'Alika',
                'penjualan_kode' => 'A0002',
                'penjualan_tanggal' => '2024-2-15',
            ],
            [
                'penjualan_id' => 3,
                'user_id' => 3,
                'pembeli' => 'Risa',
                'penjualan_kode' => 'A0003',
                'penjualan_tanggal' => '2024-2-14',
            ],
            [
                'penjualan_id' => 4,
                'user_id' => 3,
                'pembeli' => 'Indah',
                'penjualan_kode' => 'A0004',
                'penjualan_tanggal' => '2024-2-14',
            ],
            [
                'penjualan_id' => 5,
                'user_id' => 3,
                'pembeli' => 'Adi',
                'penjualan_kode' => 'A0005',
                'penjualan_tanggal' => '2024-2-17',
            ],
            [
                'penjualan_id' => 6,
                'user_id' => 3,
                'pembeli' => 'Dena',
                'penjualan_kode' => 'A0006',
                'penjualan_tanggal' => '2024-2-17',
            ],
            [
                'penjualan_id' => 7,
                'user_id' => 3,
                'pembeli' => 'Lita',
                'penjualan_kode' => 'A0007',
                'penjualan_tanggal' => '2024-2-29',
            ],
            [
                'penjualan_id' => 8,
                'user_id' => 3,
                'pembeli' => 'Akmal',
                'penjualan_kode' => 'A0008',
                'penjualan_tanggal' => '2024-2-28',
            ],
            [
                'penjualan_id' => 9,
                'user_id' => 3,
                'pembeli' => 'Disa',
                'penjualan_kode' => 'A0009',
                'penjualan_tanggal' => '2024-3-1',
            ],
            [
                'penjualan_id' => 10,
                'user_id' => 3,
                'pembeli' => 'Lea',
                'penjualan_kode' => 'A0010',
                'penjualan_tanggal' => '2024-3-3',
            ],
        ];
        DB::table('t_penjualan')->insert($data);
    }
}
