<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunicationsStudentMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communications_student_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject')->default('Message Subject');
            $table->text('message');
            $table->unsignedBigInteger('tutor_id');
            $table->dateTime('tutor_deleted_at')->nullable();
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
        Schema::dropIfExists('communications_student_messages');
    }
}
