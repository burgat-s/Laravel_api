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
        Schema::create('email_tipos', function (Blueprint $table) {
            $table->id();
            $table->string("nombre",255);
            $table->string("subject",255);
            $table->string("template",255);
            $table->text("descripcion");
            $table->enum('estado', ['A', 'B']);
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
        Schema::dropIfExists('email_tipos');
    }
};
