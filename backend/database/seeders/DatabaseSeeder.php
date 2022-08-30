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
      RolesTableSeeder::class,
      UserSeeder::class,
      AccountSeeder::class,
      CourseSeeder::class,
      CategorySeeder::class,
      LessonSeeder::class
    ]);
  }
}
