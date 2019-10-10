<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidades extends Model
{
    protected $table = 'especialidades';
    protected $primaryKey = 'cod_especialidad';
    protected $fillable = [
        'especialidad',
    ];

    public function empleados(){
        return $this->belongsToMany('App\Empleados');
    }

}
