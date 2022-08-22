<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_accesses', function (Blueprint $table) {
            $table->id();
            
            $table->boolean('display')->default(false);
            $table->boolean('requered')->default(false);
            $table->boolean('test')->default(false);
            $table->boolean('promo')->default(false);
  
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
        Schema::dropIfExists('lesson_accesses');
    }
}
