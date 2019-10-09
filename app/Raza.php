<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raza extends Model
{
    //

    protected $table = 'razas';

    public function pacientes(){
        return $this->belongsTo('App\Paciente');
    }

    public function especies(){
        return $this->hasOne('App\Paciente', 'id_especie');
    }
}
