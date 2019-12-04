<?php

namespace App\Http\Controllers\Administrador\Mantto;

use App\Http\Controllers\Controller;
use App\Especie;
use App\Raza;
use App\Tipo_usuario;
use App\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EspecieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagActual = 'especies';
        $especies = Especie::all();
        return view('administrador.mantto.especies', compact('especies','pagActual'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pagActual = 'especies';
        return view('administrador.mantto.especieAgregar', compact('pagActual'));
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
            'especie' => ['required','max:50','string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('especie.fagregar')
                ->withErrors($validator)
                ->withInput();
        }

        $especie = new Especie;
        $especie->fill([
            'especie' => $request->especie,
        ]);

        $success = $especie->save();

        if(!$success){
            return redirect()->route('especies')->with('error', 'Error al agrear al registro');
        }

        return redirect()->route('especies')->with('success', 'Registro agreado correctamente');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cod_especie)
    {
        $pagActual = 'especies';
        $especie = Especie::findOrFail($cod_especie);

        return view('administrador.mantto.especieActualizar', compact('especie','pagActual'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_especie)
    {
        $validator = Validator::make($request->all(), [
            'especie' => ['required','max:50','string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('especie.factualizar',compact('cod_especie'))
                ->withErrors($validator)
                ->withInput();
        }

        $especie = Especie::findOrFail($cod_especie);

        if($request->especie != $especie->especie){
            $especie->especie = $request->especie;
        }

        if($especie->isClean()){
            return redirect()->route('especie.factualizar',compact('cod_especie'))->with('info','Debes especificar un valor diferente')->withInput();
        }

        $success = $especie->save();

        if(!$success){
            return redirect()->route('especie.factualizar', compact('cod_especie'))->with('error', 'Error al agrear al registro');
        }

        return redirect()->route('especies')->with('success', 'Registro agreado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_especie)
    {
        $success = Especie::findOrFail($cod_especie)->delete();
        if(!$success){
            return redirect()->route('especies')->with('error', 'Error al eliminar el registro');
        }
        return redirect()->route('especies')->with('success', 'Reguistro eliminado correctamente');
    }


    public function bloquear($cod_especie){

        $especie = Especie::findOrfail($cod_especie);

        if(!$especie){
            return redirect()->route('especies')->with('error', 'La especie especificado no existe');
        }

        $razas = Raza::where('cod_especie',$cod_especie)->get();

        DB::beginTransaction();
        try{
            if($especie->is_active){
                $especie->is_active = ! $especie->is_active;
                $success = $especie->save();
                if(!$success){
                    DB::rollBack();
                    return redirect()->route('especies')->with('error', 'Error al actualizar el estado de la especie');
                }
                foreach ($razas as $raza){
                    $raza->temp = $raza->is_active;
                    $raza->is_active = 0;
                    $success = $raza->save();
                    if(!$success){
                        DB::rollBack();
                        return redirect()->route('especies')->with('error', 'Error al actulizar las razas asignadas a la especie');
                    }
                }
            }else {
                $especie->is_active = ! $especie->is_active;
                $success = $especie->save();
                if(!$success){
                    DB::rollBack();
                    return redirect()->route('especies')->with('error', 'Error al actualizar el estado de la especie');
                }

                foreach ($razas as $raza){
                    $raza->is_active = $raza->temp;
                    $raza->temp = 0;
                    $success = $raza->save();
                    if(!$success){
                        DB::rollBack();
                        return redirect()->route('especies')->with('error', 'Error al actulizar las razas asignados a la especie');
                    }
                }
            }
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('especies')->with('error', 'Error al actulizar el registro');
        }

        DB::commit();
        return redirect()->route('especies')->with('success', 'Reguistro actualizado correctamente');
    }

}
