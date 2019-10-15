<?php

namespace App\Http\Controllers\Veterinario;

use App\Consulta;
use App\Http\Controllers\Controller;
use App\Mascota;
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
        $pagActual  = 'consulta';
        $consultas = Consulta::where('estado','=',0)->where('cod_usuario','=',Auth::user()->cod_usuario)->with('mascota.raza','mascota.sexo','mascota.propietario') ->orderBy('fecha', 'asc')->get();
        return view('veterinario.consulta', compact('pagActual','consultas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($cod_expediente,$cod_consulta)
    {
        $pagActual = 'consulta';
        $mascota = Mascota::findOrFail($cod_expediente);
        $consulta = Consulta::findOrFail($cod_consulta);
        return view('veterinario.nuevaConsulta',compact('mascota','consulta','pagActual'));
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
     * @param \Illuminate\Http\Request $request
     * @param $cod_consulta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_consulta)
    {

        $validator = Validator::make($request->all(), [
            'historia_clinica'  => ['required','min:1','string'],
            'diagnostico'       => ['required','min:1','string'],
            'tratamiento'       => ['required','min:1','string'],
            'observaciones'     => ['required','min:1','string']
        ]);

        if ($validator->fails()) {
            return redirect()->route('veterinario.atender',['cod_expediente'=>$request['cod_expediente'],'cod_consulta'=>$cod_consulta])
                ->withErrors($validator)
                ->withInput();
        }

        $consulta = Consulta::findOrFail($cod_consulta);

        $consulta->fill([
            'historia_clinica' => $request['historia_clinica'],
            'diagnostico'  => $request['diagnostico'],
            'tratamiento'  => $request['tratamiento'],
            'observaciones'  => $request['observaciones'],
            'estado'  => 1
        ]);
        $success = $consulta->save();

        if(!$success){
            return redirect()->route('secretaria.nuevaConsulta')->with('error', 'Error al agregar el registro');
        }
        return redirect()->route('veterinario.consulta')->with('success', 'Registro agreado correctamente');
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
