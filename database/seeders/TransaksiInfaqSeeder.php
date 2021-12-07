<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiInfaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::connection('zakat')->table('transaksi_infaq')->insert([
        [
            'jumlah' => 100000,
            'ket' => 'Bayar Marbot',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'jumlah' => 50000,
            'ket' => 'Ganti Sapu',
            'created_at' => '2021-10-01 18:58:23',
            'updated_at' => '2021-10-01 18:58:23',
        ],
        [
            'jumlah' => 10000,
            'ket' => 'Beli Air',
            'created_at' => '2021-11-01 18:58:23',
            'updated_at' => '2021-11-01 18:58:23',
        ],
        [
            'jumlah' => 100000,
            'ket' => 'Ganti Genteng',
            'created_at' => now(),
            'updated_at' => now(),
        ],
      ]);
    }
}
