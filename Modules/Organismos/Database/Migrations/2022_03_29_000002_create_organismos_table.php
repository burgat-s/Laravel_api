<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateOrganismosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // TODO FALTA LAS RELACIONES!
    public function up()
    {
        Schema::create('organismos', function (Blueprint $table) {
            $table->increments("id",true);
            $table->enum('estado', ['A', 'B'])->nullable()->default('A');
            $table->string("descripcion",100);
            $table->string("slug",100);
            $table->string("cuit",100);
            $table->string("calle",200);
            $table->integer('calle_numero');
            $table->tinyInteger('piso')->nullable();
            $table->tinyInteger('torre')->nullable();
            $table->string("codigo_postal",50)->nullable();
            $table->enum('situacion_iva', ['Exento', 'Responsable Inscripto']);
            $table->integer('codigo_area_1')->nullable();
            $table->integer('numero_telefono_1')->nullable();
            $table->integer('codigo_area_2')->nullable();
            $table->integer('numero_telefono_2')->nullable();
            $table->string("email",200);
            $table->string("ciudad",200)->nullable();
            $table->integer('municipalidad_id')->nullable();
            $table->tinyInteger('zona_id')->nullable();
            $table->timestamps();
        });

        if (DB::getDriverName() == 'mysql') {
            DB::statement("ALTER TABLE `organismos` comment 'Tabla que guarda datos de los organismos.'");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organismos');
    }
}
