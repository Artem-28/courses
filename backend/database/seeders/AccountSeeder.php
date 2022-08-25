<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $accounts = array(
      [
        'title' => 'Главный повар',
        'user_id' => 1
      ],
      [
        'title' => 'Капусторез',
        'user_id' => 2
      ],
      [
        'title' => 'Бизмесмен',
        'user_id' => 3
      ]
    );

    DB::table('accounts')->insert($accounts);
  }
}
