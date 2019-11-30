<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipo_producto extends Model
{
    use SoftDeletes;

    protected $table = 'tipo_producto';
    protected $primaryKey = 'cod_tipo_producto';
    public $timestamps = false;

    protected $fillable = [
        'tipo_producto',
        'is_active'
    ];

    public function productos(){
        return $this->hasMany('App\Productos', 'cod_tipo_producto', 'cod_tipo_producto');
    }
}
