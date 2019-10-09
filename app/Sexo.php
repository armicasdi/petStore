<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    //
    protected $table = 'sexo';

    public function pacientes(){
        return $this->belongsTo('App\Paciente');
    }
}
