<?php

namespace App\Http\Controllers\Administrador\Mantto;

use App\Especie;
use App\Http\Controllers\Controller;
use App\Raza;
use App\vacunas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RazaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagActual = 'razas';
        $razas = Raza::where('raza','<>','Mestizo')->paginate(10);
        return view('administrador.mantto.razas', compact('razas','pagActual'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pagActual = 'razas';
        $especies = Especie::all();
        return view('administrador.mantto.razaAgregar', compact('especies','pagActual'));
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
            'raza' => ['required','max:50','string'],
            'cod_especie' => ['required','integer'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('raza.fagregar')
                ->withErrors($validator)
                ->withInput();
        }

        $raza = new Raza;
        $raza->fill([
            'raza' => $request->raza,
            'cod_especie' => $request->cod_especie,
        ]);

        $success = $raza->save();

        if(!$success){
            return redirect()->route('razas')->with('error', 'Error al agrear al registro');
        }

        return redirect()->route('razas')->with('success', 'Registro agreado correctamente');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cod_raza)
    {
        $pagActual = 'razas';
        $raza = Raza::findOrFail($cod_raza);
        $especies = Especie::all();
        return view('administrador.mantto.razaActualizar', compact('raza','especies','pagActual'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $cod_raza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_raza)
    {

        $validator = Validator::make($request->all(), [
            'raza' => ['required','max:50','string'],
            'cod_especie' => ['required','integer'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('raza.factualizar',compact('cod_raza'))
                ->withErrors($validator)
                ->withInput();
        }

        $raza = Raza::findOrFail($cod_raza);

        if($request->raza != $raza->vacuna){
            $raza->raza = $request->raza;
        }

        if($request->cod_especie != $raza->cod_especie){
            $raza->cod_especie = $request->cod_especie;
        }

        if($raza->isClean()){
            return redirect()->route('raza.factualizar',compact('cod_raza'))->with('info','Debes especificar un valor diferente')->withInput();
        }

        $success = $raza->save();

        if(!$success){
            return redirect()->route('raza.factualizar', compact('cod_raza'))->with('error', 'Error al agrear al registro');
        }

        return redirect()->route('razas')->with('success', 'Registro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_raza)
    {
        $success = Raza::findOrFail($cod_raza)->delete();
        if(!$success){
            return redirect()->route('razas')->with('error', 'Error al eliminar el registro');
        }
        return redirect()->route('razas')->with('success', 'Reguistro eliminado correctamente');
    }


    public function bloquear($cod_raza){

        $raza = Raza::findOrFail($cod_raza);
        $raza->is_active = ! $raza->is_active;
        $sucess = $raza->save();
        if(!$sucess){
            return redirect()->route('razas')->with('error', 'Error al actulizar el registro de la raza');
        }
        return redirect()->route('razas')->with('success', 'Reguistro actualizado correctamente');
    }
}
