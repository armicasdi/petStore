<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Usuarios;
use Illuminate\Http\Request;
use App\Empleados;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagActual = 'usuarios';
        $empleados =  Empleados::all();

        foreach ($empleados as $empleado){
            $empleado->usuario->tipo_usuario;
        }

        return view('administrador.empleados', compact('empleados','pagActual'));
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
     * @param $cod_usuario
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bloquearEmpleado($cod_usuario){

        $empleado = Usuarios::findOrFail($cod_usuario);
        $empleado->is_active = ! $empleado->is_active;
        $sucess = $empleado->save();
        if(!$sucess){
            return redirect()->route('admin.empleados')->with('error', 'Error al actulizar el registro del usuario');
        }
        return redirect()->route('admin.empleados')->with('success', 'Reguistro actualizado correctamente');
    }

}
