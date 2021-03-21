<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunicationsTutorMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communications_tutor_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject')->default('Subject Message');
            $table->text('message');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('tutor_id');
            $table->unsignedBigInteger('original_message_id')->nullable();
            $table->dateTime('read_at')->nullable();
            $table->dateTime('tutor_deleted_at')->nullable();
            $table->dateTime('student_deleted_at')->nullable();
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
        Schema::dropIfExists('communications_tutor_messages');
    }
}
