<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('topic');
            $table->json('objectives')->nullable();
            $table->json('study_material')->nullable();
            $table->json('activities')->nullable();
            $table->json('lesson_outcomes')->nullable();
            $table->json('learning_aids')->nullable();
            $table->dateTime('lesson_at')->nullable();
            $table->unsignedBigInteger('course_id');
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
        Schema::dropIfExists('lesson_plans');
    }
}
