<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FitrahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::connection('zakat')->table('fitrah')->insert([
        [
          'nama' => 'jaka',
          'jenis' => 'beras',
          'jumlah' => 3.5,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'nama' => 'tingkir',
          'jenis' => 'beras',
          'jumlah' => 3.5,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'nama' => 'bawa',
          'jenis' => 'uang',
          'jumlah' => 40000,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'nama' => 'kelapa',
          'jenis' => 'uang',
          'jumlah' => 40000,
          'created_at' => now(),
          'updated_at' => now(),
        ],
      ]);
    }
}
