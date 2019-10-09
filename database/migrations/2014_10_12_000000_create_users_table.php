<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('usuario', 10)->unique();
            $table->string('password', 30);
            $table->tinyInteger('is_active')->nullable();
            $table->timestamps();
            $table->rememberToken();
            $table->tinyIncrements('isLogged')->nullable();
            $table->integer('cod_tipo_usuario');
            $table->foreign('cod_tipo_usuario')->references('id')->on('tipo_usuarios');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
