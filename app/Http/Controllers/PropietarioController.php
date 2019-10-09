<?php

namespace App\Http\Controllers;
use App\Helpers\JwtAuth;
use App\Propietario;
use Illuminate\Http\Request;

class PropietarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $hash = $request->header('Authorization', null);
        $jwtAuth = new JwtAuth();
        $checkToken = $jwtAuth->checkToken($hash);
        if($checkToken) {
            $data = Propietario::all();
        }else {
            $data = array(
                'message' => 'Login Incorrecto',
                'status' => 'error',
                'codigo'=>400

            );
        }
        return response()->json($data, 200);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $hash = $request->header('Authorization', null);

        $jwtAuth = new JwtAuth();
        $checkToken = $jwtAuth->checkToken($hash);

        if($checkToken ) {


            //Recoger datos en POST
            $json = $request->input('json', null);
            $params = json_decode($json);
            $params_array =  json_decode($json, true);

            $user = $jwtAuth->checkToken($hash, true);

                //Validaciones

            $validate = $this->validate($params_array, [
                'nombres' => 'required|min:3',
                'apellidos' => 'required|min:3',
                'telefono' => 'required',
                'direccion'=>'required',
                'correo' =>'required'
            ]);
            $errors = $validate->errors();
            if($errors){
                return $errors->toJson();
            }

            if (isset($params->nombres) && isset($params->apellidos) && isset($params->direccion) && isset( $params->telefono)  && isset($params ->correo)) {
                $propietario = new propietario();

                $propietario->nombres = $params->nombre;
                $propietario->apellidos = $params->apellido;
                $propietario->direccion = $params->direccion;
                $propietario->telefono = $params->telefono;
                $propietario->correo = $params->corre;

                $propietario->save();

                $data = array(
                    'propietario' => $propietario,
                    'status' => 'success',
                    'codigo'=>200

                );
            }

        }else {
            $data = array(
                'message' => 'Login Incorrecto',
                'status' => 'error',
                'codigo'=>400

            );
        }

        return response()->json($data, 200);
    }

    public function show(Propietario $propietario)
    {
        //
    }


    public function edit(Propietario $propietario)
    {
        //
    }


    public function update(Request $request, Propietario $propietario)
    {
        //
    }


    public function destroy(Propietario $propietario)
    {
        //
    }
}
