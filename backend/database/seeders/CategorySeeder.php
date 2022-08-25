<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $categories = array(
      [
        'title' => 'Категория 1'
      ],
      [
        'title' => 'Категория 2'
      ],
      [
        'title' => 'Категория 3'
      ]
    );

    DB::table('categories')->insert($categories);
  }
}
