<?php

namespace App\Http\Controllers\Administrador;

use App\Genero;
use App\Http\Controllers\Controller;
use App\Tipo_usuario;
use App\Usuarios;
use Illuminate\Http\Request;
use App\Empleados;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $empleados =  Empleados::where('cod_usuario','<>',Auth::user()->cod_usuario)->get();

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
        $pagActual = 'usuarios';
        $tipos_usuario = Tipo_usuario::all();
        $generos = Genero::all();
        return view('administrador.agregarUsuario',compact('tipos_usuario','generos','pagActual'));
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
            'nombres'           => ['required','max:50','string'],
            'apellidos'         => ['required','max:50','string'],
            'dui'               => ['required','max:10','min:9'],
            'fech_nac'          => ['required','date'],
            'telefono1'         => ['required','max:9','string'],
            'correo'            => ['required','email'],
            'direccion'         => ['required','max:200','string'],
            'usuario'           => ['required'],
            'cod_tipo_usuario'  => ['required'],
            'cod_genero'        => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.agregar')
                ->withErrors($validator)
                ->withInput();
        }

        $val = Usuarios::where('usuario',$request['usuario'])->get();
        if(!$val->isEmpty()){
            return redirect()->route('admin.agregar')->with('warning', 'El nombre de usuario ya esta registrado')->withInput();
        }

        DB::beginTransaction();
        try{
            $usuario = new Usuarios;
            $usuario->fill([
                'usuario'    => $request['usuario'],
                'password'   => bcrypt('pass1234'),
                'cod_tipo_usuario' => $request['cod_tipo_usuario'],
            ]);
            $success = $usuario->save();

            if($success){
                $empleado = new Empleados;
                $empleado->fill([
                    'nombres'       => $request['nombres'],
                    'apellidos'     => $request['apellidos'],
                    'dui'           => $request['dui'],
                    'fech_nac'      => $request['fech_nac'],
                    'genero'        => $request['genero'],
                    'telefono1'     => $request['telefono1'],
                    'telefono2'     => $request['telefono2'],
                    'correo'        => $request['correo'],
                    'direccion'     => $request['direccion'],
                    'cod_usuario'   => $usuario->cod_usuario,
                    'cod_genero'    => $request['cod_genero'],
                ]);

                $success = $empleado->save();

                if($success){
                    DB::commit();
                }else{
                    DB::rollBack();
                    return redirect()->route('admin.agregar')->with('error', 'Error al agregar el registro del empleado');
                }
            }else{
                DB::rollBack();
                return redirect()->route('admin.agregar')->with('error', 'Error al agregar el registro del usuario');
            }
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('admin.agregar')->with('error', 'Error al agregar el registro');
        }

        return redirect()->route('admin.agregar')->with('success', 'Registro agreado correctamente');
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
