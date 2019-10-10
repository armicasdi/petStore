<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    protected $table = 'sexo';
    protected $primaryKey = 'cod_sexo';
    protected $fillable = [
        'sexo',
    ];

    public function mascotas(){
        return $this->hasMany('App\Mascota', 'cod_sexo', 'cod_sexo');
    }
}
