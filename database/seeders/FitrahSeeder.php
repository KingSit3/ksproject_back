<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FitrahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
      $faker = Faker::create('id_ID');

      for ($i=0; $i < 25; $i++) { 
        DB::connection('zakat')->table('fitrah')->insert([
          'nama' => $faker->name(),
          'no_telp' => $faker->phoneNumber(),
          'jenis' => 'beras',
          'jumlah' => 3.5,
          'created_at' => $faker->dateTimeThisYear(),
          'updated_at' => $faker->dateTimeThisYear(),
        ]);
      }

      for ($i=0; $i < 20; $i++) { 
        DB::connection('zakat')->table('fitrah')->insert([
          'nama' => $faker->name(),
          'no_telp' => $faker->phoneNumber(),
          'jenis' => 'uang',
          'jumlah' => 40000,
          'created_at' => $faker->dateTimeThisYear(),
          'updated_at' => $faker->dateTimeThisYear(),
        ]);
      }
    }
}
