<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    protected $table = 'proveedores';
    protected $primaryKey = 'cod_proveedor';
    protected $fillable = [
        'nombre_juridico',
        'nombre_comercial',
        'direccion',
        'telefono1',
        'telefono2',
        'correo',
        'descripcion',
    ];

    public function entrada_producto(){
        return $this->hasMany('App\Entrada_producto');
    }

}
