<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuarios extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'cod_usuario';
    protected $fillable = [
        'usuario',
        'password',
        'is_active',
        'isLoged',
        'cod_tipo_usuario'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tipo_usuario(){
        return $this->belongsTo('App\Tipo_usuario', 'cod_tipo_usuario');
    }
    public function empleados(){
        return $this->hasOne('App\Empleados','cod_usuario', 'cod_usuario');
    }

}
