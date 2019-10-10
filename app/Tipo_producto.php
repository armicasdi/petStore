<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_producto extends Model
{
    protected $table = 'tipo_producto';
    protected $primaryKey = 'cod_tipo_producto';
    protected $fillable = [
        'tipo_producto',
    ];

    public function productos(){
        return $this->hasMany('App\Productos', 'cod_tipo_producto', 'cod_tipo_producto');
    }
}
