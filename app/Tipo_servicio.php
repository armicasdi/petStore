<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_servicio extends Model
{
    protected $table = 'tipo_servicio';
    protected $primaryKey = 'cod_tipo_servicio';
    protected $fillable = [
        'servicio',
    ];

    public function detalle_peluqueria(){
       return $this->hasMany('App\Detalle_peluqueria', 'cod_tipo_servicio', 'cod_tipo_servicio');
    }
}
