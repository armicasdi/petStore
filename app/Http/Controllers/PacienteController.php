<?php

namespace App\Http\Controllers;

use App\Helpers\JwtAuth;
use App\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{

    public function index(Request $request)
    {
        $hash = $request->header('Authorization', null);

        $jwtAuth = new JwtAuth();
        $checkToken = $jwtAuth->checkToken($hash);
        if($checkToken) {
            $data = Paciente::all()->load(['razas', 'sexo', 'propietarios']);
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
        //
    }


    public function show(Paciente $paciente)
    {
        //
    }


    public function edit(Paciente $paciente)
    {
        //
    }


    public function update(Request $request, Paciente $paciente)
    {
        //
    }


    public function destroy(Paciente $paciente)
    {
        //
    }
}
