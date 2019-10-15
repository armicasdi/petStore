<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peluqueria extends Model
{
    protected $table = 'peluqueria';
    protected $primaryKey = 'cod_peluqueria';
    public $timestamps = false;
    protected $fillable = [
        'fecha',
        'observaciones',
        'cod_expediente',
        'estado',
        'cod_usuario',
    ];

    public function empleados(){
        return $this->belongsTo('App\Empleados', 'cod_usuario', 'cod_usuario');
    }

    public function mascota(){
        return $this->belongsTo('App\Mascota', 'cod_expediente', 'cod_expediente');
    }

    public function detalle_peluqueria(){
        return $this->hasMany('App\Detalle_peluqueria', 'cod_peluqueria', 'cod_peluqueria');
    }
}
