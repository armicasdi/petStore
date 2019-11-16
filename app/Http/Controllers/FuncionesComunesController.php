<?php

namespace App\Http\Controllers;

use App\Especie;
use App\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

        $pagActual = 'dashboard';
        $usuario = Usuarios::findOrFail($cod_usuario);
        $usuario->empleados->genero;
        $usuario->tipo_usuario;

        if(Auth::user()->tipo_usuario->tipo == 'Administrador'){
            return view('administrador.informacion',compact('usuario','pagActual'));
        }else if(Auth::user()->tipo_usuario->tipo == 'Veterinario'){
            return view('veterinario.informacion',compact('usuario','pagActual'));
        }else if(Auth::user()->tipo_usuario->tipo == 'Secretaria'){
            return view('secretaria.informacion',compact('usuario','pagActual'));
        }else if(Auth::user()->tipo_usuario->tipo == 'Inventario'){
            return view('inventario.informacion',compact('usuario','pagActual'));
        }else if(Auth::user()->tipo_usuario->tipo == 'Peluqueria') {
            return view('peluqueria.informacion', compact('usuario', 'pagActual'));
        }
    }

    public function cambioPass(){
        $pagActual = 'dashboard';

        if(Auth::user()->tipo_usuario->tipo == 'Administrador'){
            return view('administrador.password',compact('pagActual'));
        }else if(Auth::user()->tipo_usuario->tipo == 'Veterinario'){
            return view('veterinario.password',compact('pagActual'));
        }else if(Auth::user()->tipo_usuario->tipo == 'Secretaria'){
            return view('secretaria.password',compact('pagActual'));
        }else if(Auth::user()->tipo_usuario->tipo == 'Inventario'){
            return view('inventario.password',compact('pagActual'));
        }else if(Auth::user()->tipo_usuario->tipo == 'Peluqueria') {
            return view('peluqueria.password', compact( 'pagActual'));
        }

    }

    public function cambioPassUpdate(Request $request){

        $validator = Validator::make($request->all(), [
            'passwordActual' => ['required','max:15'],
            'password' => ['required','max:15','min:6','confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('cambio.fpass')
                ->withErrors($validator)
                ->withInput();
        }

        $usuario = Usuarios::findOrFail(Auth::user()->cod_usuario);

        if(! password_verify($request->passwordActual, $usuario->password)){
            return redirect()->route('cambio.fpass')->with('error', 'La constraseña actual del usuario y la igresada no son iguales');
        }

        $usuario->password = bcrypt($request->password);
        $success = $usuario->save();

        if(!$success){
            return redirect()->route('cambio.fpass')->with('error', 'Error alguardar el archivo');
        }

        Auth::logout();
    }
}
