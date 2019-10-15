<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    protected $table = 'propietario';
    protected $primaryKey = 'cod_propietario';
    public $timestamps = false;
    protected $fillable = [
        'nombres',
        'apellidos',
        'direccion',
        'telefono',
        'correo',
    ];

    public function mascota(){
        return $this->hasMany('App\Mascota','cod_propietario','cod_propietario');
    }

}
