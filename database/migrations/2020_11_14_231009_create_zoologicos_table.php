<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoologicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoologicos', function (Blueprint $table) {
            $table->increments('id_zoologico');
            $table->string('nombre',120);
            $table->string('ciudad',120);
            $table->string('pais',120);
            $table->float('tamanio');
            $table->float('presupuesto_anual');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zoologicos');
    }
}
