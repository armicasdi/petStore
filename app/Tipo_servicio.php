<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipo_servicio extends Model
{

    use SoftDeletes;

    protected $table = 'tipo_servicio';
    protected $primaryKey = 'cod_tipo_servicio';
    public $timestamps = false;
    protected $fillable = [
        'servicio',
    ];

    public function detalle_peluqueria(){
       return $this->hasMany('App\Detalle_peluqueria', 'cod_tipo_servicio', 'cod_tipo_servicio');
    }
}
