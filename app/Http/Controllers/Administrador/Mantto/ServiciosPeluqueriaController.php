<?php

namespace App\Http\Controllers\Administrador\Mantto;

use App\Http\Controllers\Controller;
use App\Tipo_servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiciosPeluqueriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagActual = 'servicios';
        $servicios = Tipo_servicio::all();
        return view('administrador.mantto.servicios', compact('servicios','pagActual'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pagActual = 'servicios';
        return view('administrador.mantto.servicioAgregar', compact('pagActual'));
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
            'servicio' => ['required','max:50','string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('servicio.fagregar')
                ->withErrors($validator)
                ->withInput();
        }

        $servicio = new Tipo_servicio;
        $servicio->fill([
            'servicio' => $request->servicio,
        ]);

        $success = $servicio->save();

        if(!$success){
            return redirect()->route('servicio.fagregar')->with('error', 'Error al agrear al registro');
        }

        return redirect()->route('servicios')->with('success', 'Registro agreado correctamente');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cod_tipo_servicio)
    {
        $pagActual = 'servicios';
        $servicio = Tipo_servicio::findOrFail($cod_tipo_servicio);

        return view('administrador.mantto.servicioActualizar', compact('servicio','pagActual'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_tipo_servicio)
    {
        $validator = Validator::make($request->all(), [
            'servicio' => ['required','max:50','string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('servicio.factualizar',compact('cod_tipo_servicio'))
                ->withErrors($validator)
                ->withInput();
        }

        $servicio = Tipo_servicio::findOrFail($cod_tipo_servicio);

        if($request->servicio != $servicio->servicio){
            $servicio->servicio = $request->servicio;
        }

        if($servicio->isClean()){
            return redirect()->route('servicio.factualizar',compact('cod_tipo_servicio'))->with('info','Debes especificar un valor diferente')->withInput();
        }

        $success = $servicio->save();

        if(!$success){
            return redirect()->route('servicio.factualizar', compact('cod_tipo_servicio'))->with('error', 'Error al agrear al registro');
        }

        return redirect()->route('servicios')->with('success', 'Registro agreado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_tipo_servicio)
    {
        $success = Tipo_servicio::findOrFail($cod_tipo_servicio)->delete();
        if(!$success){
            return redirect()->route('servicios')->with('error', 'Error al eliminar el registro');
        }
        return redirect()->route('servicios')->with('success', 'Reguistro eliminado correctamente');
    }

    public function bloquear($cod_tipo_servicio){

        $servicio = Tipo_servicio::findOrFail($cod_tipo_servicio);
        $servicio->is_active = ! $servicio->is_active;
        $sucess = $servicio->save();
        if(!$sucess){
            return redirect()->route('servicios')->with('error', 'Error al actulizar el registro de los servicios');
        }
        return redirect()->route('servicios')->with('success', 'Reguistro actualizado correctamente');
    }
}
