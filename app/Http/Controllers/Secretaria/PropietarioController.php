<?php

namespace App\Http\Controllers\Secretaria;

use App\Http\Controllers\Controller;
use App\Propietario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PropietarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagActual = 'epropietario';

        return view('secretaria.actualizarPropietario', compact('pagActual'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


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
     * @param $cod_propietario
     * @return void
     */
    public function editar($cod_propietario)
    {
        $pagActual = 'epropietario';
        $propietario = Propietario::findOrFail($cod_propietario);
        return view('secretaria.editarPropietario', compact('propietario','pagActual'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_propietario)
    {
        $validator = Validator::make($request->all(), [
            'nombresPropietario'    => ['required','max:50','string'],
            'apellidosPropietario'  => ['required','max:50','string'],
            'direccion'             => ['required','max:200','string'],
            'telefono'              => ['required','min:8','max:9','string'],
            'correo'                => ['required','email'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('secretaria.actualizarPropietario',compact('cod_propietario'))
                ->withErrors($validator)
                ->withInput();
        }

            $propietario = Propietario::findOrFail($cod_propietario);
            $propietario->fill([
                'nombres'    => $request['nombresPropietario'],
                'apellidos'  => $request['apellidosPropietario'],
                'direccion'  => $request['direccion'],
                'telefono'   => $request['telefono'],
                'correo'     => $request['correo']
            ]);
            $success = $propietario->save();

            if(!$success){
                return redirect()->route('secretaria.actualizarPropietario',compact('cod_propietario'))->with('error', 'Error al actulizar el registro');
            }

        return redirect()->route('secretaria.actualizarPropietario')->with('success', 'Registro actulizado correctamente');

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
