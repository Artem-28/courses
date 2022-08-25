<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $users = array(
      [
        'email' => '1@1',
        'password' => '1'
      ],
      [
        'email' => '2@2',
        'password' => '2'
      ],
      [
        'email' => '3@3',
        'password' => '3'
      ]
    );

    DB::table('users')->insert($users);
  }
}
