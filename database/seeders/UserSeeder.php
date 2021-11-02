<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        [
          'name' => 'indra',
          'email' => 'indra@gmail.com',
          'role' => '0',
          'password' => Hash::make('12345'),
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'name' => 'admin',
          'email' => 'admin@gmail.com',
          'role' => '1',
          'password' => Hash::make('12345'),
          'created_at' => now(),
          'updated_at' => now(),
        ]
      ]);
    }
}
