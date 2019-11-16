<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuarios extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $table = 'usuarios';
    protected $primaryKey = 'cod_usuario';
    protected $fillable = [
        'usuario',
        'password',
        'is_active',
        'isLogged',
        'cod_tipo_usuario',
        'reset_pass'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tipo_usuario(){
        return $this->belongsTo('App\Tipo_usuario', 'cod_tipo_usuario', 'cod_tipo_usuario');
    }
    public function empleados(){
        return $this->hasOne('App\Empleados','cod_usuario', 'cod_usuario');
    }

}
