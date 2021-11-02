<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('mal')->insert([
        [
          'nama' => 'Z23',
          'jenis' => 'penghasilan',
          'data' => json_encode([
                      "penghasilan" => 5000000,
                      "keperluan" => 2000000,
                      "hutang" => 50000,
                    ]),
          'total' => 250000,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'nama' => 'Javelin',
          'jenis' => 'penghasilan',
          'data' => json_encode([
                      "penghasilan" => 4000000,
                      "keperluan" => 1500000,
                      "hutang" => 100000,
                    ]),
          'total' => 300000,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'nama' => 'Laffey',
          'jenis' => 'emas',
          'data' => json_encode([
                      "total_emas" => 100,
                      "harga_emas" => 800000,
                      "keperluan" => 2000000,
                      "hutang" => 50000,
                    ]),
          'total' => 550000,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'nama' => 'California',
          'jenis' => 'emas',
          'data' => json_encode([
                      "total_emas" => 90,
                      "harga_emas" => 820000,
                      "keperluan" => 1500000,
                      "hutang" => 75000,
                    ]),
          'total' => 400000,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'nama' => 'Ayanami',
          'jenis' => 'sapi',
          'data' => json_encode([
                      "total_sapi" => 50,
                    ]),
          'total' => '1 sapi musinnah',
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'nama' => 'Unicorn',
          'jenis' => 'sapi',
          'data' => json_encode([
                      "total_sapi" => 45,
                    ]),
          'total' => '1 sapi tabi',
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'nama' => 'Illustrious',
          'jenis' => 'kambing',
          'data' => json_encode([
                      'total_kambing' => 90,
                    ]),
          'total' => '1 kambing',
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'nama' => 'Takao',
          'jenis' => 'kambing',
          'data' => json_encode([
                      "total_kambing" => 70,
                    ]),
          'total' => '2 kambing',
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'nama' => 'Le Malin',
          'jenis' => 'pertanian',
          'data' => json_encode([
                      "total_panen" => 800,
                      "harga" => 12000,
                      "zakat_pertanian" => 0.05,
                    ]),
          'total' => 200000,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'nama' => 'Shimakaze',
          'jenis' => 'pertanian',
          'data' => json_encode([
                      "total_panen" => 900,
                      "harga" => 11000,
                      "zakat_pertanian" => 0.10,
                    ]),
          'total' => 240000,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        
      ]);
    }
}
