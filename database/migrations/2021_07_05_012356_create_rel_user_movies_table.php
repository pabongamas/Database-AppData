<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelUserMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relusuariopelicula', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('idusuario');
            $table->smallInteger('idpelicula');
            $table->foreign('idusuario')->references('idusuario')->on('usuario');
            $table->foreign('idpelicula')->references('idpelicula')->on('pelicula');
            $table->smallInteger('calificacion');
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
        Schema::dropIfExists('relusuariopelicula');
    }
}
