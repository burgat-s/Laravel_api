<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido', 100)->nullable();
            $table->string('email')->unique('notusuarios_usuemail_unique');
            $table->timestamp('fecha_verificacion')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken()->nullable();
            $table->boolean('admin')->default(0);
            $table->enum('sexo', ['M', 'F'])->default('M');
            $table->unsignedInteger('dni')->nullable();
            $table->integer('organismo_id')->nullable()->index('fk_usuario_organismo_idx');
            $table->string('telefono', 50)->nullable();
            $table->string('refresh_pass_token')->nullable();
            $table->timestamp('refresh_pass_created_at')->nullable();
            $table->timestamp('refresh_pass_last_updated_at')->nullable();
            $table->integer('failed_attempts')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
