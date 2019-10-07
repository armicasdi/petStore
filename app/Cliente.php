<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    protected $table = 'clientes';

    //relacion One To Many

    public function mascotas(){
        return $this->hasMany('App\Mascota');
    }






}
