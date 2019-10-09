<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombres', 50);
            $table->string('dui', 10);
            $table->date('fecha_nacimiento');
            $table->string('telefono', 15);
            $table->string('telefono', 15)->nullable();
            $table->string('email',50);
            $table->integer('cod_usuario');
            $table->integer('cod_civil');
            $table->tinyInteger('cod_genero');
            $table->foreign(cod_usuario)->references('id')->on('usuarios');
            $table->foreign('cod_civil')->references('id')->on('estado_civil');
            $table->foreign('cod_genero')->references('id')->on('genero');
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
        Schema::dropIfExists('empleado');
    }
}
