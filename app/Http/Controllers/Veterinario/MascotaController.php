<?php

namespace App\Http\Controllers\Veterinario;

use App\Consulta;
use App\Control_vacunas;
use App\Http\Controllers\Controller;
use App\Mascota;
use App\Peluqueria;
use App\Propietario;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagActual = 'mascota';
        return view('veterinario.mascota', compact('pagActual'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($cod_expediente)
    {
       $pagActual = 'mascota';
       $mascota = Mascota::findOrFail($cod_expediente);
       $mascota->propietario;
       $mascota->raza;
       $mascota->sexo;
       $consultas = Consulta::where('cod_expediente',$cod_expediente)
                    ->where('estado',1)
                    ->orderBy('fecha','desc')
                    ->limit(5)
                    ->get();
       $vacunas = Control_vacunas::where('cod_expediente',$cod_expediente)
                    ->where('estado',1)
                    ->orderBy('fecha','desc')
                    ->limit(5)
                    ->with('vacunas','empleados')
                    ->get();
       $peluqueria = Peluqueria::where('cod_expediente',$cod_expediente)
                    ->where('estado',1)
                    ->orderBy('fecha','desc')
                    ->limit(5)
                    ->with(['detalle_peluqueria.tipo_servicio','empleados'])
                    ->get();
       return view('veterinario.historial', compact('mascota','consultas', 'vacunas', 'peluqueria','pagActual'));
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

    public function busqueda($metodo,$busqueda){

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
                if(!$data->isEmpty()){
                    $resultado['data'] = $data;
                    $resultado['tipo'] = 2;
                }
                break;
            case '3':
                $data = Propietario::where('nombres', 'like', "$busqueda%")->with('mascota.raza')->get();
                if(!$data->isEmpty()){
                    $resultado['data'] = $data;
                    $resultado['tipo'] = 3;
                }
        }

        return response()->json($resultado);
    }

}
