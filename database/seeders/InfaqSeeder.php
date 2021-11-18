<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::connection('zakat')->table('infaq')->insert([
        [
          'nama' => 'Kokomi',
          'jumlah' => 30000,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'nama' => 'Ei',
          'jumlah' => 50000,
          'created_at' => now(),
          'updated_at' => '2021-10-01 18:58:23',
        ],
        [
          'nama' => 'Ganyu',
          'jumlah' => 40000,
          'created_at' => now(),
          'updated_at' => '2021-10-02 18:58:23',
        ],
      ]);
    }
}
