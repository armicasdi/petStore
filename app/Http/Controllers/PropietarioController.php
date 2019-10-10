<?php

namespace App\Http\Controllers;
use App\Helpers\JwtAuth;
use App\Propietario;
use Illuminate\Http\Request;

class PropietarioController extends Controller
{

    public function index(Request $request)
    {

        $hash = $request->header('Authorization', null);
        $jwtAuth = new JwtAuth();
        $checkToken = $jwtAuth->checkToken($hash);
        if($checkToken) {
            $data = Propietario::all()->load('pacientes');
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
            //$user = $jwtAuth->checkToken($hash, true);
            //$request->merge($params_array);

            /*try{
                $validate = $this->validate($request, [
                    'nombres' => 'required|min:3',
                    'apellidos' => 'required|min:3',
                    'telefono' => 'required',
                    'direccion'=>'required',
                    'correo' =>'required'
                ]);

            }catch (\Illuminate\Validation\ValidationException $e){
                return $e->getResponse();
            }*/

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
        $data = Propietario::find($propietario)->load('pacientes');
        return response()->json($data, 200);

    }


    public function edit(Propietario $propietario)
    {

    }


    public function update(Request $request, Propietario $propietario)
    {

    }


    public function destroy(Propietario $propietario)
    {

    }
}
