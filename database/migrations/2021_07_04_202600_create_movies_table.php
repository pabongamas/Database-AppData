<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelicula', function (Blueprint $table) {
            $table->bigIncrements('idpelicula');
            $table->string('titulo',100);
            $table->string('genero',20);
            $table->string('duracion',20);
            $table->string('resumen',1000);
            $table->string('director',100);
            $table->string('urlubicacion',200);
            $table->string('clasificacion',25);
            $table->string('anioestreno',20);
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
        Schema::dropIfExists('pelicula');
    }
}
