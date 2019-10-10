<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_usuario extends Model
{
    protected $table = 'tipo_usuario';
    protected $primaryKey = 'cod_tipo_usuario';
    protected $fillable = [
        'tipo',
        'isActive',
    ];

    public function usuarios(){
        return $this->hasMany('App\Usuarios','cod_tipo_usuario','cod_tipo_usuario');
    }
}
