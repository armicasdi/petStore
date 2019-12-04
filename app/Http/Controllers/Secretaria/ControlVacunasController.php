<?php

namespace App\Http\Controllers\Secretaria;

use App\Control_vacunas;
use App\Empleados;
use App\Http\Controllers\Controller;
use App\Mascota;
use App\Peluqueria;
use App\Usuarios;
use App\vacunas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ControlVacunasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param null $cod_expediente
     * @return \Illuminate\Http\Response
     */
    public function create($cod_expediente = null)
    {
        // Verificar si hay consulta pendiente
        $val = Control_vacunas::where('cod_expediente',$cod_expediente)->where('estado',0)->get();
        if(!$val->isEmpty()){
            session()->flash('info','La mascota tiene vacunas pendientes');
        }

        if($cod_expediente){
            $pagActual = 'consulta';
            $mascota = Mascota::findOrFail($cod_expediente);
            $vacunas = vacunas::where('is_active', 1)->get();
            $veterinarios = Empleados::whereHas('usuario',function ($consulta){
                $consulta->where('is_active',1);
            })->whereHas('usuario.tipo_usuario',function ($consulta){
                $consulta->where('cod_tipo_usuario','=',2);
            })->get();
            return view('secretaria.nuevaVacuna',compact('mascota','pagActual','vacunas','veterinarios'));
        }
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cod_vacuna'     => ['required'],
            'cod_expediente' => ['required'],
            'cod_usuario'    => ['required']
        ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $vacuna = new Control_vacunas;

        $vacuna->fill([
            'cod_vacuna'    => $request['cod_vacuna'],
            'cod_expediente'  => $request['cod_expediente'],
            'cod_usuario'  => $request['cod_usuario']
        ]);
        $success = $vacuna->save();

        if(!$success){
            return redirect()->route('secretaria.consulta')->with('error', 'Error al agregar el registro');
        }
        return redirect()->route('secretaria.consulta')->with('success', 'Registro agreado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
