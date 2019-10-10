<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    protected $table = 'especies';
    protected $primaryKey  = 'cod_especie';
    protected $fillable = [
        'especie'
    ];

    public function razas(){
        return $this->hasMany('App\Raza', 'cod_especie', 'cod_especie');
    }
}
