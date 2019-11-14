<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class vacunas extends Model
{
    use SoftDeletes;

    protected $table = 'vacunas';
    protected $primaryKey = 'cod_vacuna';
    public $timestamps = false;

    protected $fillable = [
        'vacuna',
    ];

    public function control_vacunas(){
        return $this->hasMany('App\Control_vacunas', 'cod_vacuna', 'cod_vacuna');
    }
}
