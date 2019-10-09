<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table='pacientes';

    public function cliente(){
        return $this->belongsTo('App/Cliente', 'cliente_id');
    }
}
