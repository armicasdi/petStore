<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bodega extends Model
{
    use SoftDeletes;

    protected $table = 'bodega';
    protected $primaryKey = 'cod_bodega';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
    ];

    public function productos(){
        return $this->hasMany('App\Productos', 'cod_bodega','cod_bodega');
    }
}
