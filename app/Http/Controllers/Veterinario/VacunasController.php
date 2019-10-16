<?php

namespace App\Http\Controllers\Veterinario;

use App\Consulta;
use App\Control_vacunas;
use App\Empleados;
use App\Http\Controllers\Controller;
use App\Mascota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $pagActual  = 'vacuna';
        $vacunas = Control_vacunas::where('estado','=',0)->where('cod_usuario','=',Auth::user()->cod_usuario)->with('mascota.raza','mascota.sexo','mascota.propietario') ->orderBy('fecha', 'asc')->get();
        return view('veterinario.vacuna', compact('pagActual','vacunas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $cod_expediente
     * @param $cod_control_vacunas
     * @return \Illuminate\Http\Response
     */
    public function create($cod_expediente, $cod_control_vacunas)
    {

        $pagActual = 'consulta';
        $mascota = Mascota::findOrFail($cod_expediente);
        $vacuna = Control_vacunas::findOrFail($cod_control_vacunas);
        $vacuna->vacunas;
        $historial = Control_vacunas::where('cod_expediente',$cod_expediente)->where('estado',1)->with('empleados','vacunas')->orderBy('fecha','desc')->limit(5)->get();
        return view('veterinario.nuevaVacuna',compact('mascota','vacuna','historial','pagActual'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param $cod_control_vacunas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_control_vacunas)
    {
        $validator = Validator::make($request->all(), [
            'cod_vacuna'       => ['required']
        ]);

        if ($validator->fails()) {
            return redirect()->route('veterinario.atenderVacuna',['cod_expediente'=>$request['cod_expediente'],'cod_control_vacunas'=>$cod_control_vacunas])
                ->withErrors($validator)
                ->withInput();
        }

        $vacuna = Control_vacunas::findOrFail($cod_control_vacunas);

        $vacuna->fill([
            'cod_vacuna'  => $request['cod_vacuna'],
            'proxima' => $request['proxima'],
            'estado'  => 1
        ]);
        $success = $vacuna->save();

        if(!$success){
            return redirect()->back()->with('error', 'Error al agregar el registro');
        }
        return redirect()->route('veterinario.vacunas')->with('success', 'Registro actulizado correctamente');
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
