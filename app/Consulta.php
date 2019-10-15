<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table = 'consulta';
    protected $primaryKey = 'cod_consulta';
    public $timestamps = false;
    protected $fillable = [
        'peso',
        'temperatura',
        'fr_cardiaca',
        'referido',
        'historia_clinica',
        'diagnostico',
        'tratamiento',
        'observaciones',
        'cod_usuario',
        'cod_expediente',
        'estado',
        'fecha',
    ];

    public function empleados(){
        return $this->belongsTo('App\Empleados', 'cod_usuario', 'cod_usuario');
    }

    public function mascota(){
        return $this->belongsTo('App\Mascota', 'cod_expediente', 'cod_expediente');
    }
}
