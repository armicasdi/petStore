<?php

namespace App\Http\Controllers\Administrador\Mantto;

use App\Http\Controllers\Controller;
use App\vacunas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VacunasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagActual = 'vacunas';
        $vacunas = vacunas::all();
        return view('administrador.mantto.vacunas', compact('vacunas','pagActual'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pagActual = 'vacunas';
        return view('administrador.mantto.vacunaAgregar', compact('pagActual'));
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
            'vacuna' => ['required','max:70','string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('vacuna.fagregar')
                ->withErrors($validator)
                ->withInput();
        }

        $vacuna = new vacunas;
        $vacuna->fill([
            'vacuna' => $request->vacuna,
        ]);

        $success = $vacuna->save();

        if(!$success){
            return redirect()->route('vacunas')->with('error', 'Error al agrear al registro');
        }

        return redirect()->route('vacunas')->with('success', 'Registro agreado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cod_vacuna)
    {
        $pagActual = 'vacunas';
        $vacuna = vacunas::findOrFail($cod_vacuna);

        return view('administrador.mantto.vacunaActualizar', compact('vacuna','pagActual'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_vacuna)
    {
        $validator = Validator::make($request->all(), [
            'vacuna' => ['required','max:70','string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('vacuna.factualizar',compact('cod_vacuna'))
                ->withErrors($validator)
                ->withInput();
        }

        $vacuna = vacunas::findOrFail($cod_vacuna);

        if($request->vacuna != $vacuna->vacuna){
            $vacuna->vacuna = $request->vacuna;
        }

        if($vacuna->isClean()){
            return redirect()->route('vacuna.factualizar',compact('cod_vacuna'))->with('error','Debes especificar un valor diferente')->withInput();
        }

        $success = $vacuna->save();

        if(!$success){
            return redirect()->route('vacuna.factualizar')->with('error', 'Error al agrear al registro');
        }

        return redirect()->route('vacunas')->with('success', 'Registro agreado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_vacuna)
    {
        $success = vacunas::findOrFail($cod_vacuna)->delete();
        if(!$success){
            return redirect()->route('vacunas')->with('error', 'Error al eliminar el registro');
        }
        return redirect()->route('vacunas')->with('success', 'Reguistro eliminado correctamente');
    }

    public function bloquear($cod_vacuna){

        $vacuna = vacunas::findOrFail($cod_vacuna);
        $vacuna->is_active = ! $vacuna->is_active;
        $sucess = $vacuna->save();
        if(!$sucess){
            return redirect()->route('vacunas')->with('error', 'Error al actulizar el registro de la vacuna');
        }
        return redirect()->route('vacunas')->with('success', 'Reguistro actualizado correctamente');
    }
}
