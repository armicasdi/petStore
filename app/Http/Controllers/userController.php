<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class userController extends Controller
{
    public function register(Request $request){
        //Recoger Info


        $json = $request->input('json', null);
        $parametros = json_decode($json);

        $nombre = (!is_null($json)&&isset($parametros->nombre)) ? $parametros->nombre : null;
        $apellido = (!is_null($json)&&isset($parametros->apellido)) ? $parametros->apellido : null;
        $email = (!is_null($json)&&isset($parametros->email)) ? $parametros->email : null;
        $usuario = (!is_null($json)&&isset($parametros->usuario)) ? $parametros->usuario : null;
        $password = (!is_null($json)&&isset($parametros->password)) ? $parametros->password : null;

        if(!is_null($nombre) && !is_null($email) && !is_null($usuario) && !is_null($password)){

            //Crear Usuario

            $nuevoUsuario = new User();
            $nuevoUsuario->nombre = $nombre;
            $nuevoUsuario->apellido = $apellido;
            $nuevoUsuario->email = $email;
            $nuevoUsuario->usuario = $usuario;

            $pwd = hash('sha256', $password);
            $nuevoUsuario->password = $pwd;

            $isset_user = User::where('usuario', '=', $usuario)->count();



            if($isset_user == 0){
                $nuevoUsuario->save();

                $data = array(
                    'status'=>'success',
                    'code' => 200,
                    'message' => 'Usuario Registrado Correctamente '
                );

            }else{
                $data = array(
                    'status'=>'error',
                    'code' => 400,
                    'message' => 'Usuario Duplicado '
                );
            }


        }else {
            $data = array(
                'status'=>'error',
                'code' => 400,
                'message' => 'Usuario no creado '
            );
        }

        return response()->json($data, 200);

    }
}
