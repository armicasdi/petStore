<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'cod_producto';
    protected $fillable = [
        'nombre',
        'precio',
        'cantidad',
        'cod_bodega',
        'cod_tipo_producto',
    ];

    public function detalle_entrada(){
        return $this->hasMany('App\Detalle_entrada', 'cod_producto','cod_producto');
    }

    public function bodega(){
        return $this->belongsTo('App\Bodega', 'cod_bodega','cod_bodega');
    }

    public function tipo_producto(){
        return $this->belongsTo('App\Tipo_producto', 'cod_tipo_producto','cod_tipo_producto');
    }

}
