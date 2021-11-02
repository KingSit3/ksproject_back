<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MustahikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('mustahik')->insert([
        [
          'nama' => 'mona',
          'rt' => 1,
          'rw' => 10,
          'jumlah' => 4,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'nama' => 'ping-hai',
          'rt' => 2,
          'rw' => 10,
          'jumlah' => 3,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'nama' => 'ning-hai',
          'rt' => 3,
          'rw' => 11,
          'jumlah' => 3,
          'created_at' => now(),
          'updated_at' => now(),
        ],
      ]);
    }
}
