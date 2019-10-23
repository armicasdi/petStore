<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    protected $table = 'empleados';
    protected $primaryKey = 'cod_usuario';
    public $timestamps = false;
    protected $fillable = [
        'nombres',
        'apellidos',
        'dui',
        'fech_nac',
        'telefono1',
        'telefono2',
        'correo',
        'cod_usuario',
        'cod_genero',
        'direccion',
    ];

    public function estado_civil(){
        return $this->belongsTo('App\Estado_civil','cod_civil','cod_civil');
    }

    public function genero(){
        return $this->belongsTo('App\Genero','cod_genero','cod_genero');
    }

    public function especialidades(){
        return $this->belongsToMany('App\Especialidades', 'empleados_especialidades', 'cod_usuario','cod_especialidad');
    }

    public function entrada_producto(){
        return $this->hasMany('App\Entrada_producto', 'cod_usuario', 'cod_usuario');
    }

    public function consulta(){
        return $this->hasMany('App\Consulta','cod_usuario','cod_usuario');
    }

    public function control_vacunas(){
        return $this->hasMany('App\Control_vacunas','cod_usuario','cod_usuario');
    }

    public function peluqueria(){
        return $this->hasMany('App\Peluqueria','cod_usuario','cod_usuario');
    }

    public function usuario(){
        return $this->hasOne('App\Usuarios', 'cod_usuario', 'cod_usuario');
    }

}
