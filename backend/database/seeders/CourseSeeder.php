<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $courses = array(
      [
        'title' => 'Варим борщ',
        'description' => 'Без кутюр',
        'account_id' => 1
      ],
      [
        'title' => 'Стрежем капусту',
        'description' => 'а также помидоры и ананасы',
        'account_id' => 1
      ],
      [
        'title' => 'Бизнес',
        'description' => 'Бизнес модель поведения и все что с этим связано',
        'account_id' => 2
      ]
    );

    DB::table('courses')->insert($courses);
  }
}
