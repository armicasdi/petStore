<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table='pacientes';

    public function propiertarios(){
        return $this->belongsTo('App\Propietario', 'id_propietario');
    }

    public function sexo (){
        return $this->hasOne('App\Sexo', 'id_sexo');

    }

    public function razas(){
        return $this->hasOne('App\Raza', 'id_raza');
    }
}
