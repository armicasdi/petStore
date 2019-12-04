<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_venta extends Model
{
    protected $table = 'detalle_venta';
    protected $primaryKey = 'cod_detalle_venta';
    public $timestamps = false;
    protected $fillable = [
        'cantidad',
        'valor',
        'cod_venta',
        'cod_producto',
    ];


    public function venta(){
        return $this->belongsTo('App\Venta','cod_venta', 'cod_venta');
    }

    public function producto(){
        return $this->belongsTo('App\Productos', 'cod_producto','cod_producto');
    }


}
