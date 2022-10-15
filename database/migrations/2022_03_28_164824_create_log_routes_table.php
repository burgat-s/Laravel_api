<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_routes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('method');
            $table->string('url');
            $table->longText('payload');
            $table->longText('body');
            $table->longText('response')->nullable();
            $table->smallInteger('code')->nullable();
            $table->string('duration')->nullable();
            $table->string('controller');
            $table->string('action');
            $table->string('ip');
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
        Schema::dropIfExists('log_routes');
    }
}
