<?php

namespace App\Http\Controllers\Secretaria;

use App\Especie;
use App\Http\Controllers\Controller;
use App\Mascota;
use App\Propietario;
use App\Sexo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MascotasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sexos = Sexo::all();
        $especies = Especie::all();
        $pagActual = 'agregar';

        return view('secretaria.agregarMascota', compact('sexos','especies','pagActual'));
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
            'nombresPropietario'    => ['required','max:50','string'],
            'apellidosPropietario'  => ['required','max:50','string'],
            'direccion'             => ['required','max:200','string'],
            'telefono'              => ['required','max:9','string'],
            'correo'                => ['required','email'],
            'nombreMascota'         => ['required','max:30','string'],
            'fechaNacimiento'       => ['required','date'],
            'color'                 => ['required','max:40','string'],
            'sexo'                  => ['required'],
            'especie'               => ['required'],
            'raza'                  => ['required'],
            'tipo'                  => ['max:100'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('secretaria.crear')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try{
           $propietario = new Propietario;
           $propietario->fill([
               'nombres'    => $request['nombresPropietario'],
               'apellidos'  => $request['apellidosPropietario'],
               'direccion'  => $request['direccion'],
               'telefono'   => $request['telefono'],
               'correo'     => $request['correo']
           ]);
           $success = $propietario->save();

           if($success){
               $mascota = new Mascota;
               // Generando una clave de 8 digitos
               $prefijo = strtoupper(substr($request['nombreMascota'],0,2));
               $aleatorio = substr(mt_rand(),0,4);
               $postfijo = date("y");
               $clave = $prefijo.$aleatorio.$postfijo;

               $mascota->cod_expediente = $clave;
               $mascota->nombre     = $request['nombreMascota'];
               $mascota->fecha_nac  = $request['fechaNacimiento'];
               $mascota->Color     = $request['color'];
               $mascota->cod_propietario = $propietario->cod_propietario;
               $mascota->cod_sexo   = $request['sexo'];
               $mascota->cod_raza   = $request['raza'];
               if($request->raza == 29 || $request->raza == 30){
                   $mascota->tipo = $request['tipo'];
               }

               $success = $mascota->save();

               if($success){
                   DB::commit();
               }else{
                   DB::rollBack();
                   return redirect()->route('secretaria.crear')->with('error', 'Error al agregar el registro de la mascota');
               }
           }else{
               DB::rollBack();
               return redirect()->route('secretaria.crear')->with('error', 'Error al agregar el registro del propietario');
           }
        }catch (\Exception $e){
                DB::rollBack();
            return redirect()->route('secretaria.crear')->with('error', 'Error al agregar el registro');
        }

        return redirect()->route('secretaria.crear')->with('success', 'Registro agreado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
