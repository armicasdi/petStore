<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('peso');
            $table->float('temperatura');
            $table->float('fr_cardiaca');
            $table->text('tratamiento');
            $table->text('observaciones');
            $table->text('diagnostico');
            $table->boolean('estado');
            $table->timestamps();
            $table->integer('cod_usuario');
            $table->integer('cod_expedientes');

            $table->foreign('cod_usuario')->references('id')->on('usuarios');
            $table->foreign('cod_expedientes')->references('id')->on('pacientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultas');
    }
}
