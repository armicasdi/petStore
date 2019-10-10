<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vacunas extends Model
{
    protected $table = 'vacunas';
    protected $primaryKey = 'cod_vacuna';
    protected $fillable = [
        'vacuna',
    ];

    public function control_vacunas(){
        return $this->hasMany('App\Control_vacunas', 'cod_vacuna', 'cod_vacuna');
    }
}
