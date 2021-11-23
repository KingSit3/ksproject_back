<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call([
        FitrahSeeder::class,
        InfaqSeeder::class,
        MalSeeder::class,
        MustahikSeeder::class,
        UserSeeder::class,
        TransaksiSeeder::class,
      ]);
    }
}
