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
          'alamat' => 'jalan kanan kiri no.60',
          'rt' => '02',
          'rw' => '04',
          'kelurahan' => 'kakal',
          'kecamatan' => 'ciputat',
          'jumlah_anggota_keluarga' => 4,
          'jenis_zakat' => 'beras',
          'jumlah_zakat' => 14,
          'created_at' => now(),
        ],
        [
          'nama_keluarga' => 'ping-hai',
          'alamat' => 'jalan kiri no.66',
          'rt' => '01',
          'rw' => '04',
          'kelurahan' => 'mans',
          'kecamatan' => 'ciputat',
          'jumlah_anggota_keluarga' => 3,
          'jenis_zakat' => 'beras',
          'jumlah_zakat' => 10.5,
          'created_at' => now(),
        ],
        [
          'nama_keluarga' => 'ning-hai',
          'alamat' => 'jalan kanan no.64',
          'rt' => '01',
          'rw' => '04',
          'kelurahan' => 'laks',
          'kecamatan' => 'pamulang',
          'jumlah_anggota_keluarga' => 2,
          'jenis_zakat' => 'uang',
          'jumlah_zakat' => 50000,
          'created_at' => now(),
        ],
      ]);
    }
}
