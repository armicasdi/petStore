<?php

namespace App\Http\Controllers;

use App\Especie;
use App\Raza;
use Illuminate\Http\Request;

class FuncionesComunesController extends Controller
{
    public function obtenerRazas($id){
        if($id != 0){
            $razas = Especie::findOrFail($id)->razas;
            return response()->json($razas);
        }else{
            return '';
        }
    }
}
