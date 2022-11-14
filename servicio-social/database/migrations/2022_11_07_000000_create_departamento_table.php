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
        Schema::create('departamento', function (Blueprint $table) {
            $table->increments('departamento_id');
            $table->string('departamento');
            $table->string('abreviatura_departamento');
            $table->integer('jefe_departamento_id');
            $table->foreign('jefe_departamento_id')->references('jefe_departamento_id')->on('jefe_departamento');
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
        Schema::dropIfExists('departamento');
    }
};