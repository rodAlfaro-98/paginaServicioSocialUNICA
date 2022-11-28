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
        Schema::create('alumno', function (Blueprint $table) {
            $table->increments('id');
            $table->string('correo')->unique();
            $table->integer('numero_cuenta')->unique();
            $table->string('nombres');
            $table->string('apellido_paterno');
            $table->string('apellido_materno')->nullable();
            $table->date('fecha_nacimiento');
            $table->string('curp')->unique();
            $table->string('genero');
            $table->double('telefono_casa');
            $table->double('telefono_celular');
            $table->integer('creditos_pagados');
            $table->double('avance_porcentaje');
            $table->double('promedio');
            $table->date('fecha_ingreso_facultad');
            $table->integer('duracion_servicio');
            $table->integer('horas_semana');
            $table->string('hora_inicio');
            $table->string('hora_fin');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('contraseña');
            $table->boolean('interno');
            $table->integer('carrera_id');
            $table->foreign('carrera_id')->references('id')->on('carrera');
            $table->integer('departamento_id');
            $table->foreign('departamento_id')->references('id')->on('departamento');
            $table->integer('estado_id');
            $table->foreign('estado_id')->references('id')->on('estado');
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
        Schema::dropIfExists('alumno');
    }
};