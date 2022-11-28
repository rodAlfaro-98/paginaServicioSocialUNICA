<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_estado', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_estado');
            $table->integer('estado_id');
            $table->foreign('estado_id')->references('id')->on('estado');
            $table->integer('departamento_id');
            $table->foreign('departamento_id')->references('id')->on('departamento');
            $table->integer('alumno_id');
            $table->foreign('alumno_id')->references('id')->on('alumno');
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
        Schema::dropIfExists('historico_estado');
    }
};