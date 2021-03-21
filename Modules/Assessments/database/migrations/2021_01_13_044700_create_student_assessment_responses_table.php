<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAssessmentResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_assessment_responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('assessment_id');
            $table->json('student_response')->nullable();
            $table->json('assessment_result')->nullable();
            $table->integer('points')->nullable();
            $table->dateTime('saved_at')->nullable();
            $table->dateTime('submitted_at')->nullable();
            $table->dateTime('assessed_at')->nullable();
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
        Schema::dropIfExists('student_assessment_responses');
    }
}
