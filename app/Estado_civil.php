<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado_civil extends Model
{
    protected $table = 'estado_civil';
    protected $primaryKey  = 'cod_civil';
    protected $fillable = [
        'estado',
    ];

    public function empleados(){
        return $this->hasMany('App\Empleados', 'cod_civil', 'cod_civil');
    }
}
