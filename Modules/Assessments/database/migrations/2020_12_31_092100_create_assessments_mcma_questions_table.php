<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentsMCMAQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessments_mcma_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question');
            $table->string('A');
            $table->string('B');
            $table->string('C');
            $table->string('D');
            $table->string('E');
            $table->string('F');
            $table->string('correct_answers');
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
        Schema::dropIfExists('assessments_mcma_questions');
    }
}
