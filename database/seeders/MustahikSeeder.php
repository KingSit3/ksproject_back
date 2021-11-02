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
      DB::connection('zakat')->table('mustahik')->insert([
        [
          'nama_keluarga' => 'mona',
          'alamat' => 'jalan kanan kiri Rt01/04 kel. kaka kec. lala no.60',
          'jumlah_anggota_keluarga' => 4,
          'jumlah_yang_diterima' => 14,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'nama_keluarga' => 'ping-hai',
          'alamat' => 'jalan aka kec. lala no.60',
          'jumlah_anggota_keluarga' => 3,
          'jumlah_yang_diterima' => 10.5,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'nama_keluarga' => 'ning-hai',
          'alamat' => 'jalan kanan Rt01/04 no.60',
          'jumlah_anggota_keluarga' => 2,
          'jumlah_yang_diterima' => 7,
          'created_at' => now(),
          'updated_at' => now(),
        ],
      ]);
    }
}
