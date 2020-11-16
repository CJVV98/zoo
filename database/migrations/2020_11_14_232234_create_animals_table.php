<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animales', function (Blueprint $table) {
            $table->increments('id_animal');
            $table->integer('especie_id')->unsigned();
            $table->integer('zoologico_id')->unsigned();
            $table->integer('num_identificacion');
            $table->enum('sexo',['Hembra','Macho']);
            $table->smallInteger('anio_nacimiento');
            $table->string('pais_origen',120);
            $table->string('continente',120);
            $table->foreign('especie_id')->references('id_especie')->on('especies') 
                  ->onDelete('cascade');
            $table->foreign('zoologico_id')->references('id_zoologico')->on('zoologicos')   ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animales');
    }
}
