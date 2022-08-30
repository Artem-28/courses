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
    $users = array(
      [
        'id' => 1,
        'email' => '1@1',
        'password' => Hash::make(1)
      ],
      [
        'id' => 2,
        'email' => '2@2',
        'password' => Hash::make(2)
      ],
      [
        'id' => 3,
        'email' => '3@3',
        'password' => Hash::make(3)
      ]
    );

    $role_users = array(
      [
        'role' => 'business',
        'user_id' => 1
      ],
      [
        'role' => 'teacher',
        'user_id' => 2
      ],
      [
        'role' => 'student',
        'user_id' => 3
      ]
    );

    $profiles = array(
      [
        'user_id' => 1
      ],
      [
        'user_id' => 2
      ],
      [
        'user_id' => 3
      ]
    );

    DB::table('users')->insert($users);
    DB::table('role_users')->insert($role_users);
    DB::table('profiles')->insert($profiles);
  }
}
