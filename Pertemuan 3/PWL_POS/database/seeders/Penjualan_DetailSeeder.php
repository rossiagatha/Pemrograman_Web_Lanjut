<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Penjualan_DetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'detail_id' => 1,
                'penjualan_id' => 1,
                'barang_id' => 111,
                'harga' => 10000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 2,
                'penjualan_id' => 2,
                'barang_id' => 112,
                'harga' => 11000,
                'jumlah' => 3,
            ],
            [
                'detail_id' => 3,
                'penjualan_id' => 3,
                'barang_id' => 221,
                'harga' => 57000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 4,
                'penjualan_id' => 4,
                'barang_id' => 222,
                'harga' => 80000,
                'jumlah' => 1,
            ],
            [
                'detail_id' => 5,
                'penjualan_id' => 5,
                'barang_id' => 331,
                'harga' => 51000,
                'jumlah' => 1,
            ],
            [
                'detail_id' => 6,
                'penjualan_id' => 6,
                'barang_id' => 332,
                'harga' => 95000,
                'jumlah' => 1,
            ],
            [
                'detail_id' => 7,
                'penjualan_id' => 7,
                'barang_id' => 441,
                'harga' => 53000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 8,
                'penjualan_id' => 8,
                'barang_id' => 442,
                'harga' => 43000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 9,
                'penjualan_id' => 9,
                'barang_id' => 551,
                'harga' => 46000,
                'jumlah' => 1,
            ],
            [
                'detail_id' => 10,
                'penjualan_id' => 10,
                'barang_id' => 552,
                'harga' => 21000,
                'jumlah' => 1,
            ],
        ];
        DB::table('t_penjualan_detail')->insert($data);
    }
}
