<?php

namespace App\Http\Controllers;

use App\Especie;
use App\Raza;
use App\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function informacion($cod_usuario){

        $usuario = Usuarios::findOrFail($cod_usuario)->with('tipo_usuario','empleados');
        dd($usuario);

        return view('comun.informacion');
    }
}
