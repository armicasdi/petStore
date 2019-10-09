<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table = 'consultas';

    public function pacientes(){
        return $this->belongsTo('App\Paciente');
    }
}
