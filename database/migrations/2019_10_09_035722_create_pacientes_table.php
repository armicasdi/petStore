<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 100 );
            $table->date('fecha_nacimiento' );
            $table->string('color', 100);
            $table->timestamps();
            $table->integer('cod_cliente');
            $table->integer('cod_sexo');
            $table->integer('cod_raza');

            $table->foreign('cod_cliente')->references('id')->on('clientes');
            $table->foreign('cod_sexo')->references('id')->on('sexo');
            $table->foreign('cod_raza')->references('id')->on('razas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
