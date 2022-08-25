<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

      {
        $lessons = array(
          [
            'title' => 'Урок 1',
            'description' => 'Без кутюр',
            'account_id' => 1
          ],
          [
            'title' => 'Урок 2',
            'description' => 'а также помидоры и ананасы',
            'account_id' => 1
          ],
          [
            'title' => 'Урок 3',
            'description' => 'Бизнес модель поведения и все что с этим связано',
            'account_id' => 2
          ],
          [
            'title' => 'Урок 4',
            'description' => 'Бизнес что с этим связано',
            'account_id' => 2
          ],
          [
            'title' => 'Урок 5',
            'description' => 'модель поведения и этим связано',
            'account_id' => 1
          ]
        );
    
        DB::table('lessons')->insert($lessons);
      }

}
