<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaMarcacions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marcacions', function (Blueprint $table) {
            //marcacions            
            $table->increments('id');
            $table->integer('idEmpleado');
            $table->integer('idTurno');
            $table->dateTime('entrada');
            $table->dateTime('salida');
            $table->integer('minutosTardanza');
            $table->integer('horasEfectivas');
            $table->integer('minutosEfectivos');
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
        Schema::dropIfExists('marcacions');
    }
}
