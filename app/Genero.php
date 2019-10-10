<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $table = 'genero';
    protected $primaryKey  = 'cod_genero';
    protected $fillable = [
        'genero',
    ];

    public function empleados(){
        return $this->hasMany('App\Empleados', 'cod_genero', 'cod_genero');
    }
}
