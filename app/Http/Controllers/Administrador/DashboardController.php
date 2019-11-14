<?php

namespace App\Http\Controllers\Administrador;

use App\Consulta;
use App\Control_vacunas;
use App\Http\Controllers\Controller;
use App\Mascota;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
<<<<<<< HEAD


=======
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
>>>>>>> 1464e84c1d8cbec249ace1c83275e534d89b29cc
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Consulta gráfica
        $viewer = DB::table('consulta')
        ->select(DB::raw('count(cod_consulta) as cod_count')) 
        ->where('estado','=',1)
        ->groupBy(DB::raw('year(fecha)')) 
        ->get()->toArray();
        $viewer = array_column($viewer, 'cod_count');


        $pagActual = 'dashboard';
        $year = date("Y");
        $mes = date("m");
        $dia = date("d");
        $mAtendidas = Consulta::where('estado','=',1)->where('fecha','like',"$year-$mes-$dia%")->count();
        $mAtendidasSemana = Consulta::where('fecha','>',Carbon::now()->subDay(7))->count();
        $mAtendidasMes = Consulta::where('fecha','like',"$year-$mes-%")->where('estado','=',1)->count();
        $mTotal = Mascota::all()->count();

        return view('administrador.inicio',compact('mAtendidas','mAtendidasSemana','mAtendidasMes','mTotal','pagActual','viewer')) ->with('viewer',json_encode($viewer,JSON_NUMERIC_CHECK));
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
