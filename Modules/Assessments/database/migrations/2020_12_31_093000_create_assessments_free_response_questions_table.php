<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentsFreeResponseQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessments_free_response_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question');
            $table->text('comment')->nullable();
            $table->integer('points')->default(1);
            $table->integer('sequence')->nullable();
            $table->unsignedBigInteger('assessment_id');
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
        Schema::dropIfExists('assessments_free_response_questions');
    }
}
