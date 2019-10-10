<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bodega extends Model
{
    protected $table = 'bodega';
    protected $primaryKey = 'cod_bodega';
    protected $fillable = [
        'nombre',
    ];

    public function productos(){
        return $this->hasMany('App\Productos', 'cod_bodega','cod_bodega');
    }
}
