<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleados_especialidades extends Model
{
    protected $table = 'empleados_especialidades';
    protected $primaryKey = 'cod_empleados_especialidades';
    protected $fillable = [
        'institucion',
        'fecha_especializacion',
        'cod_especialidad',
        'cod_usuario',
    ];

    public function empleados(){
        return $this->belongsTo('App\Empleados','cod_usuario', 'cod_usuario');
    }

    public function especialidades(){
        return $this->belongsTo('App\Especialidades','cod_especialidad', 'cod_especialidad');
    }


}
