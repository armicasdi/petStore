<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raza extends Model
{
    protected $table = 'razas';
    protected $primaryKey = 'cod_raza';
    public $timestamps = false;
    protected $fillable = [
        'raza',
        'cod_especie',
        'temp',
    ];

    public function mascota(){
        return $this->hasMany('App\Mascota', 'cod_raza', 'cod_raza');
    }

    public function especie(){
        return $this->belongsTo('App\Especie', 'cod_especie', 'cod_especie');
    }
}
