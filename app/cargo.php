<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cargo extends Model
{
    //
    protected $table ='cargos';

    public function empleados(){
        return $this->belongsTo('App\Empleado');
    }
}
