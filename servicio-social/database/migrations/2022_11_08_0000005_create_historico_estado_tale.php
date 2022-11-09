<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricoEstadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_estado', function (Blueprint $table) {
            $table->increments('historico_estado_id');
            $table->date('fecha_estado');
            $table->integer('estado_id');
            $table->foreign('estado_id')->references('estado_id')->on('estado');
            $table->foreign('departamento_id')->references('departamento_id')->on('departamento');
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
}