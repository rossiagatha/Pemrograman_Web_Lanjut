<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'stok_id' => 1,
                'barang_id' => 111,
                'user_id' => 2,
                'stok_tanggal' => '2024-2-1',
                'stok_jumlah' => 100,
            ],
            [
                'stok_id' => 2,
                'barang_id' => 112,
                'user_id' => 2,
                'stok_tanggal' => '2024-2-3',
                'stok_jumlah' => 100,
            ],
            [
                'stok_id' => 3,
                'barang_id' => 221,
                'user_id' => 2,
                'stok_tanggal' => '2024-2-2',
                'stok_jumlah' => 10,
            ],
            [
                'stok_id' => 4,
                'barang_id' => 222,
                'user_id' => 2,
                'stok_tanggal' => '2024-2-7',
                'stok_jumlah' => 20,
            ],
            [
                'stok_id' => 5,
                'barang_id' => 331,
                'user_id' => 2,
                'stok_tanggal' => '2024-2-1',
                'stok_jumlah' => 10,
            ],
            [
                'stok_id' => 6,
                'barang_id' => 332,
                'user_id' => 2,
                'stok_tanggal' => '2024-2-2',
                'stok_jumlah' => 10,
            ],
            [
                'stok_id' => 7,
                'barang_id' => 441,
                'user_id' => 2,
                'stok_tanggal' => '2024-2-21',
                'stok_jumlah' => 20,
            ],
            [
                'stok_id' => 8,
                'barang_id' => 442,
                'user_id' => 2,
                'stok_tanggal' => '2024-3-1',
                'stok_jumlah' => 20,
            ],
            [
                'stok_id' => 9,
                'barang_id' => 551,
                'user_id' => 2,
                'stok_tanggal' => '2024-3-2',
                'stok_jumlah' => 10,
            ],
            [
                'stok_id' => 10,
                'barang_id' => 552,
                'user_id' => 2,
                'stok_tanggal' => '2024-2-29',
                'stok_jumlah' => 10,
            ],
        ];
        DB::table('t_stok')->insert($data);
    }
}
