<?php

namespace App\Http\Controllers\Administrador;

use App\Empleados;
use App\Http\Controllers\Controller;
use App\Tipo_usuario;
use App\Usuarios;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagActual = 'roles';
        $roles =  Tipo_usuario::where('cod_tipo_usuario','<>',1)->get();

        return view('administrador.roles', compact('roles','pagActual'));
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

    /**
     * @param $cod_tipo_usuario
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bloquearRol($cod_tipo_usuario){

        $rol = Tipo_usuario::findOrFail($cod_tipo_usuario);
        $rol->isActive = ! $rol->isActive;
        $sucess = $rol->save();
        if(!$sucess){
            return redirect()->route('admin.roles')->with('error', 'Error al actulizar el registro del usuario');
        }
        return redirect()->route('admin.roles')->with('success', 'Reguistro actualizado correctamente');
    }
}
