<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class InfaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create('id_ID');

      for ($i=0; $i < 100; $i++) { 
        DB::connection('zakat')->table('infaq')->insert([
          'nama' => $faker->name(),
          'jumlah' => $faker->randomNumber(5, true),
          'created_at' => $faker->dateTimeThisYear(),
          'updated_at' => $faker->dateTimeThisYear(),
        ]);
      }
    }
}
