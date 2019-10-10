<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raza extends Model
{
    protected $table = 'razas';
    protected $primaryKey = 'cod_raza';
    protected $fillable = [
        'raza',
        'cod_especie',
    ];

    public function especie(){
        return $this->belongsTo('App\Especie', 'cod_especie', 'cod_especie');
    }
}
