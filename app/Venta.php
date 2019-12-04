<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'venta';
    protected $primaryKey = 'cod_venta';
    public $timestamps = false;
    protected $fillable = [
        'fecha',
        'cod_usuario',
    ];


    public function empleado(){
        return $this->belongsTo('App\Empleados','cod_usuario', 'cod_usuario');
    }

    public function detalle_venta(){
        return $this->hasMany('App\Detalle_venta', 'cod_venta', 'cod_venta');
    }

}
