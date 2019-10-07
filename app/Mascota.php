<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mascota extends Model
{
    protected $table='mascotas';

    //Relacion de Muchos a Uno
    public function cliente(){
          return $this->belongsTo('App/Cliente', 'cliente_id');
    }
}
