<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrada_producto extends Model
{
    protected $table = 'entrada_producto';
    protected $primaryKey = 'cod_entrada';
    protected $fillable = [
        'descripcion',
        'fecha',
        'cod_proveedor',
        'cod_usuario'
    ];

    public function empleados(){
        return $this->belongsTo('App\Empleados','cod_usuario','cod_usuario');
    }

    public function proveedores(){
        return $this->belongsTo('App\Proveedores','cod_preveedor','cod_proveedor');
    }

    public function detalle_entrada(){
        return $this->hasMany('App\Detalle_entrada','cod_entrada','cod_entrada');
    }

}
