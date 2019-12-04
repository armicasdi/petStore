<?php

namespace App\Http\Controllers\Administrador\Mantto;

use App\Bodega;
use App\Http\Controllers\Controller;
use App\vacunas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BodegaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagActual = 'bodegas';
        $bodegas = Bodega::all();
        return view('administrador.mantto.bodegas', compact('bodegas','pagActual'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pagActual = 'bodegas';
        return view('administrador.mantto.bodegaAgregar', compact('pagActual'));
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
            'nombre' => ['required','max:45','string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('bodega.fagregar')
                ->withErrors($validator)
                ->withInput();
        }

        $bodega = new Bodega;
        $bodega->fill([
            'nombre' => $request->nombre,
        ]);

        $success = $bodega->save();

        if(!$success){
            return redirect()->route('bodegas')->with('error', 'Error al agrear al registro');
        }

        return redirect()->route('bodegas')->with('success', 'Registro agreado correctamente');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cod_bodega)
    {
        $pagActual = 'bodegas';
        $bodega = Bodega::findOrFail($cod_bodega);

        return view('administrador.mantto.bodegaActualizar', compact('bodega','pagActual'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_bodega)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => ['required','max:45','string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('bodega.factualizar',compact('cod_bodega'))
                ->withErrors($validator)
                ->withInput();
        }

        $bodega = Bodega::findOrFail($cod_bodega);

        if($request->nombre != $bodega->nombre){
            $bodega->nombre = $request->nombre;
        }

        if($bodega->isClean()){
            return redirect()->route('bodega.factualizar',compact('cod_bodega'))->with('info','Debes especificar un valor diferente')->withInput();
        }

        $success = $bodega->save();

        if(!$success){
            return redirect()->route('bodegas.factualizar', compact('cod_bodega'))->with('error', 'Error al agrear al registro');
        }

        return redirect()->route('bodegas')->with('success', 'Registro agreado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_bodega)
    {
        $success = Bodega::findOrFail($cod_bodega)->delete();
        if(!$success){
            return redirect()->route('bodegas')->with('error', 'Error al eliminar el registro');
        }
        return redirect()->route('bodegas')->with('success', 'Reguistro eliminado correctamente');
    }

    public function bloquear($cod_bodega){

        $bodega = Bodega::findOrFail($cod_bodega);
        $bodega->is_active = ! $bodega->is_active;
        $sucess = $bodega->save();
        if(!$sucess){
            return redirect()->route('bodegas')->with('error', 'Error al actulizar el registro de la bodega');
        }
        return redirect()->route('bodegas')->with('success', 'Reguistro actualizado correctamente');
    }
}
