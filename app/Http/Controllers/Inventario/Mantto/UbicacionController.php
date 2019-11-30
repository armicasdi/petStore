<?php

namespace App\Http\Controllers\Inventario\Mantto;

use App\Bodega;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagActual = 'ubicacion';
        $ubicaciones = Bodega::orderBy('is_active', 'desc')->paginate(10);
        return view('inventario.mantto.ubicacion', compact('ubicaciones','pagActual'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pagActual = 'ubicacion';
        return view('inventario.mantto.ubicacionAgregar', compact('pagActual'));
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
            'nombre' => ['required','unique:bodega,nombre','max:45','string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('ubicacion.fagregar')
                ->withErrors($validator)
                ->withInput();
        }

        $ubicacion = new Bodega();
        $ubicacion->fill([
            'nombre' => $request->nombre,
        ]);

        $success = $ubicacion->save();

        if(!$success){
            return redirect()->route('ubicaciones')->with('error', 'Error al agrear al registro');
        }

        return redirect()->route('ubicaciones')->with('success', 'Registro agreado correctamente');
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
    public function edit($cod_bodega)
    {
        $pagActual = 'ubicacion';
        $ubicacion = Bodega::findOrFail($cod_bodega);
        return view('inventario.mantto.ubicacionActualizar', compact('ubicacion','pagActual'));
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
            'nombre' => ['required','unique:bodega,nombre,'. $cod_bodega. ',cod_bodega','max:45','string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('ubicacion.factualizar',compact('cod_bodega'))
                ->withErrors($validator)
                ->withInput();
        }

        $ubiacion = Bodega::findOrFail($cod_bodega);

        if($request->nombre != $ubiacion->nombre){
            $ubiacion->nombre = $request->nombre;
        }

        if($ubiacion->isClean()){
            return redirect()->route('ubicacion.factualizar',compact('cod_bodega'))->with('error','Debes especificar un valor diferente')->withInput();
        }

        $success = $ubiacion->save();

        if(!$success){
            return redirect()->route('ubicacion.factualizar')->with('error', 'Error al agrear al registro');
        }

        return redirect()->route('ubicaciones')->with('success', 'Registro agreado correctamente');
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
            return redirect()->route('ubicaciones')->with('error', 'Error al eliminar el registro');
        }
        return redirect()->route('ubicaciones')->with('success', 'Reguistro eliminado correctamente');
    }

    public function bloquear($cod_bodega){

        $bodega = Bodega::findOrFail($cod_bodega);
        $bodega->is_active = ! $bodega->is_active;
        $sucess = $bodega->save();
        if(!$sucess){
            return redirect()->route('ubicaciones')->with('error', 'Error al actulizar el registro de la ubicacion');
        }
        return redirect()->route('ubicaciones')->with('success', 'Reguistro actualizado correctamente');
    }
}
