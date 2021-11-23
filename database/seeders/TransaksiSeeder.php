<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('zakat')->table('transaksi')->insert([
            [
                'mustahik_id' => 1,
                'jenis_zakat' => 'uang',
                'jumlah' => 100000,
                'status' => 1,
                'created_at' => now(),
            ],
            [
                'mustahik_id' => 2,
                'jenis_zakat' => 'uang',
                'jumlah' => 100000,
                'status' => 0,
                'created_at' => now(),
            ],
            [
                'mustahik_id' => 1,
                'jenis_zakat' => 'beras',
                'jumlah' => 3.5,
                'status' => 1,
                'created_at' => now(),
            ],
            [
                'mustahik_id' => 1,
                'jenis_zakat' => 'uang',
                'jumlah' => 50000,
                'status' => 1,
                'created_at' => now(),
            ],
            [
                'mustahik_id' => 2,
                'jenis_zakat' => 'beras',
                'jumlah' => 3.5,
                'status' => 1,
                'created_at' => now(),
            ],
        ]);
    }
}
