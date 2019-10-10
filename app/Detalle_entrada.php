<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_entrada extends Model
{
    protected $table = 'detalle_entrada';
    protected $primaryKey = 'cod_detalle';
    protected $fillable = [
        'cantidad',
        'valor',
        'fecha_vencimiento',
        'cod_entrada',
        'cod_producto',
    ];

    public function productos(){
        return $this->belongsTo('App\Productos', 'cod_producto','cod_producto');
    }
}
