<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("email_tipo_id");
            $table->enum('status', ['EN', 'ER' , 'PEN'])->nullable();
            $table->string("to_email",255);
            $table->text("body");
            $table->string("subject",255);
            $table->text("microservice_response")->nullable();
            $table->integer('attempts')->nullable();
            $table->integer('email_id')->nullable();
            $table->integer('err_no')->nullable();
            $table->text("err_msg")->nullable();
            $table->text("attach")->nullable();
            $table->datetime('sent_date')->nullable();
            $table->datetime('creation_date');
            $table->datetime('modification_date')->nullable();
            $table->unsignedBigInteger('usuario_id',)->unsigned()->nullable();

            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('email_tipo_id')->references('id')->on('email_tipos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emails');
    }
};
