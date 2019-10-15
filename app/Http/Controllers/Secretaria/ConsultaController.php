<?php

namespace App\Http\Controllers\Secretaria;

use App\Consulta;
use App\Control_vacunas;
use App\Empleados;
use App\Http\Controllers\Administrador\VacunasController;
use App\Http\Controllers\Controller;
use App\Mascota;
use App\Propietario;
use App\vacunas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagActual = 'consulta';
        return view('secretaria.consulta', compact('pagActual'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pagActual = 'consulta';

        return view('secretaria.nuevaConsulta', compact('pagActual'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $metodo
     * @param  string  $busqueda
     * @return \Illuminate\Http\Response
     */
    public function show($metodo,$busqueda)
    {
        $resultado = ['data'=>'','tipo'=>0];
        switch ($metodo) {
            case '1':
                $data = Mascota::find($busqueda);
                if ($data) {
                    $data->raza;
                    $data->propietario;
                    $resultado['data'] = $data;
                    $resultado['tipo'] = 1;
                }
                break;
            case '2':
                $data = Mascota::where('nombre', 'like', "$busqueda%")->with(['raza', 'propietario'])->get();
                if($data){
                    $resultado['data'] = $data;
                    $resultado['tipo'] = 2;
                }
                break;
            case '3':
                $data = Propietario::where('nombres', 'like', "$busqueda%")->with('mascota.raza')->get();
                if($data){
                    $resultado['data'] = $data;
                    $resultado['tipo'] = 3;
                }
        }

        return response()->json($resultado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createConsulta($cod_expediente = null){
       if($cod_expediente){
           $pagActual = 'consulta';
           $mascota = Mascota::findOrFail($cod_expediente);
           $veterinarios = Empleados::with('usuario.tipo_usuario')->whereHas('usuario.tipo_usuario', function ($query){
               $query->where('cod_tipo_usuario', '=', 2);
           })->get();
           return view('secretaria.nuevaConsulta',compact('mascota','pagActual','veterinarios'));
       }
       return redirect()->back();
    }

    public function storeConsulta(Request $request){

        $validator = Validator::make($request->all(), [
            'peso'         => ['required'],
            'temperatura'  => ['required'],
            'fr_cardiaca'  => ['required'],
            'cod_expediente'  => ['required'],
            'cod_usuario'  => ['required']
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
            $consulta = new Consulta;

            $consulta->fill([
                'peso'    => $request['peso'],
                'temperatura'  => $request['temperatura'],
                'fr_cardiaca'  => $request['fr_cardiaca'],
                'referido'  => $request['referido'] ? 1 : 0,
                'cod_usuario'  => Auth::user()->cod_usuario,
                'cod_expediente'  => $request['cod_expediente'],
                'cod_usuario'  => $request['cod_usuario'],
            ]);
            $success = $consulta->save();

            if(!$success){
                return redirect()->route('secretaria.consulta')->with('error', 'Error al agregar el registro');
            }
        return redirect()->route('secretaria.consulta')->with('success', 'Registro agreado correctamente');
    }

}
