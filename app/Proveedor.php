<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use SoftDeletes;

    protected $table = 'proveedores';
    protected $primaryKey = 'cod_proveedor';
    public $timestamps = false;
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
