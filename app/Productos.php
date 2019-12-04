<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productos extends Model
{
    use SoftDeletes;

    protected $table = 'productos';
    protected $primaryKey = 'cod_producto';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'precio',
        'cantidad',
        'cod_bodega',
        'cod_tipo_producto',
    ];

    public function detalle_entrada(){
        return $this->hasMany('App\Detalle_entrada', 'cod_producto', 'cod_producto');
    }

    public function bodega(){
        return $this->belongsTo('App\Bodega', 'cod_bodega','cod_bodega');
    }

    public function tipo_producto(){
        return $this->belongsTo('App\Tipo_producto', 'cod_tipo_producto','cod_tipo_producto');
    }

    public function detalle_venta(){
        return $this->hasMany('App\Detalle_venta', 'cod_producto','cod_producto');
    }
}
