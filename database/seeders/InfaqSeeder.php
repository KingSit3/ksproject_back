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
      DB::table('infaq')->insert([
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
          'updated_at' => now(),
        ],
        [
          'nama' => 'Ganyu',
          'jumlah' => 40000,
          'created_at' => now(),
          'updated_at' => now(),
        ],
      ]);
    }
}
