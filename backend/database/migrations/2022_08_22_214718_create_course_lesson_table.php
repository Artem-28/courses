<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_lesson', function (Blueprint $table) {
          $table->id();
          
          $table->unsignedBigInteger('course_id');
          $table->foreign('course_id')
            ->references('id')
            ->on('courses')
            ->onDelete('cascade');

          $table->unsignedBigInteger('lesson_id');
          $table->foreign('lesson_id')
              ->references('id')
              ->on('lessons')
              ->onDelete('cascade');

          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_lesson');
    }
}
