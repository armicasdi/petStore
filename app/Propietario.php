<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    protected $table = 'propietarios';

    public function pacientes(){
        return $this->hasMany('App\Paciente', 'id_propietario');
    }
}
