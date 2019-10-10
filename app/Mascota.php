<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    protected $table = 'mascotas';
    protected $primaryKey = 'cod_expediente';
    protected $fillable = [
      'nombre',
      'fecha_nac',
      'Color',
      'cod_propietario',
      'cod_sexo',
      'cod_raza',
    ];

    public function propietario(){
        return $this->belongsTo('App\Propietario','cod_propietario', 'cod_propietario');
    }

    public function raza(){
        return $this->belongsTo('App\Raza', 'cod_raza', 'cod_raza');
    }
    public function sexo(){
        return $this->belongsTo('App\Sexo', 'cod_sexo', 'cod_sexo');
    }

    public function consultas(){
        return $this->hasMany('App\Consulta', 'cod_expediente', 'cod_expediente' );
    }

     public function control_vacunas(){
        return $this->hasMany('App\Control_vacunas', 'cod_expediente', 'cod_expediente' );
    }

    public function peluqueria(){
        return $this->hasMany('App\Peluqueria', 'cod_expediente', 'cod_expediente' );
    }


}
