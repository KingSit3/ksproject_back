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
          'no_telp' => 1202482425912,
          'jenis' => 'beras',
          'jumlah' => 3.5,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'nama' => 'tingkir',
          'no_telp' => 8192054821,
          'jenis' => 'beras',
          'jumlah' => 3.5,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'nama' => 'bawa',
          'jenis' => 'uang',
          'no_telp' => null,
          'jumlah' => 40000,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'nama' => 'kelapa',
          'no_telp' => null,
          'jenis' => 'uang',
          'jumlah' => 40000,
          'created_at' => now(),
          'updated_at' => now(),
        ],
      ]);
    }
}
