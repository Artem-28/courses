<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
          $table->id();

          $table->string('title');
          $table->text('description')->nullable();
          $table->integer('order')->nullable();
          
          $table->unsignedBigInteger('account_id');
          $table->foreign('account_id')
            ->references('id')
            ->on('accounts')
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
        Schema::dropIfExists('lessons');
    }
}
