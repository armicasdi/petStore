<?php

namespace App\Http\Controllers\Peluqueria;

use App\Peluqueria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagActual = 'dashboard';
        $year = date("Y");
        $mes = date("m");
        $dia = date("d");

        $mAtender = Peluqueria::where('estado','=',0)->where('cod_usuario','=',Auth::user()->cod_usuario)->count();
        $mAtendidas = Peluqueria::where('fecha','like',"$year-$mes-$dia%")->where('estado','=',1)->where('cod_usuario','=',Auth::user()->cod_usuario)->count();
        $mAtendidasMes = Peluqueria::where('fecha','like',"$year-$mes-%")->where('estado','=',1)->where('cod_usuario','=',Auth::user()->cod_usuario)->count();

        return view('peluqueria.inicio', compact('pagActual','mAtender','mAtendidas','mAtendidasMes'));
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
