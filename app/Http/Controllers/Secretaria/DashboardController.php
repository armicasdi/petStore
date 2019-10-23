<?php

namespace App\Http\Controllers\Secretaria;

use App\Consulta;
use App\Control_vacunas;
use App\Http\Controllers\Controller;
use App\Peluqueria;
use Illuminate\Http\Request;

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

        $consultas = Consulta::orderBy('fecha','desc')->limit(10)->with('mascota.raza','mascota.propietario','empleados')->get();
        $vacunas = Control_vacunas::orderBy('fecha','desc')->limit(10)->with('mascota.raza','mascota.propietario','empleados','vacunas')->get();
        $servicios = Peluqueria::orderBy('fecha','desc')->limit(10)->with('mascota.raza','mascota.propietario','empleados')->get();
        return view('secretaria.inicio',compact('consultas','vacunas','servicios','pagActual'));
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
