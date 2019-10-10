<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_peluqueria extends Model
{
    protected $table = 'detalle_peluqueria';
    protected $primaryKey = 'cod_detalle';
    protected $fillable = [
        'fecha',
        'cod_tipo_servicio',
        'cod_peluqueria',
        'estado',
    ];

    public function peluqueria(){
        return $this->belongsTo('App\Peluqueria', 'cod_peluqueria', 'cod_peluqueria');
    }

    public function tipo_servicio(){
        return $this->belongsTo('App\Tipo_servicio', 'cod_tipo_servicio', 'cod_tipo_servicio');
    }

}
