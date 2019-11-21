<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Control_vacunas extends Model
{
    protected $table = 'control_vacunas';
    protected $primaryKey = 'cod_control_vacunas';
    public $timestamps = false;
    protected $fillable = [
        'fecha',
        'cod_vacuna',
        'cod_expediente',
        'proxima',
        'estado',
        'cod_usuario',
    ];

    public function empleados(){
        return $this->belongsTo('App\Empleados', 'cod_usuario', 'cod_usuario');
    }

    public function mascota(){
        return $this->belongsTo('App\Mascota', 'cod_expediente', 'cod_expediente');
    }

    public function vacunas(){
        return  $this->belongsTo('App\vacunas', 'cod_vacuna', 'cod_vacuna');
    }
}
