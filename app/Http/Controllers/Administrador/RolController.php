<?php

namespace App\Http\Controllers\Administrador;

use App\Bodega;
use App\Http\Controllers\Controller;
use App\Mascota;
use App\Propietario;
use App\Tipo_usuario;
use App\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
    public function edit($cod_tipo_usuario)
    {
        $pagActual = 'rol';
        $rol = Tipo_usuario::findOrFail($cod_tipo_usuario);
        return view('administrador.editarRol', compact('rol','pagActual'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_tipo_usuario )
    {
        $validator = Validator::make($request->all(), [
            'tipo' => ['required','max:30','string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.feditarRol',compact('cod_tipo_usuario'))
                ->withErrors($validator)
                ->withInput();
        }

        $rol = Tipo_usuario::findOrFail($cod_tipo_usuario);

        if($request->tipo != $rol->tipo){
            $rol->tipo = $request->tipo;
        }

        if($rol->isClean()){
            return redirect()->route('admin.feditarRol',compact('cod_tipo_usuario'))->with('info','Debes especificar un valor diferente')->withInput();
        }

        $success = $rol->save();

        if(!$success){
            return redirect()->route('admin.feditarRol')->with('error', 'Error al actualizar al registro');
        }

        return redirect()->route('admin.roles')->with('success', 'Registro actualizado correctamente');
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

        $rol = Tipo_usuario::findOrfail($cod_tipo_usuario);

        if(!$rol){
            return redirect()->route('admin.roles')->with('error', 'El rol especificado no existe');
        }

        $usuarios = Usuarios::where('cod_tipo_usuario',$cod_tipo_usuario)->get();

        DB::beginTransaction();
        try{
            if($rol->isActive){
                $rol->isActive = ! $rol->isActive;
                $success = $rol->save();
                if(!$success){
                    DB::rollBack();
                    return redirect()->route('admin.roles')->with('error', 'Error al actualizar el estado del rol');
                }
                foreach ($usuarios as $usuario){
                    $usuario->temp = $usuario->is_active;
                    $usuario->is_active = 0;
                    $success = $usuario->save();
                    if(!$success){
                        DB::rollBack();
                        return redirect()->route('admin.roles')->with('error', 'Error al actulizar los usuarios asignados al rol');
                    }
                }
            }else {
                $rol->isActive = ! $rol->isActive;
                $success = $rol->save();
                if(!$success){
                    DB::rollBack();
                    return redirect()->route('admin.roles')->with('error', 'Error al actualizar el estado del rol');
                }

                foreach ($usuarios as $usuario){
                    $usuario->is_active = $usuario->temp;
                    $usuario->temp = 0;
                    $success = $usuario->save();
                    if(!$success){
                        DB::rollBack();
                        return redirect()->route('admin.roles')->with('error', 'Error al actulizar los usuarios asignados al rol');
                    }
                }
            }
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('admin.roles')->with('error', 'Error al actulizar el registro');
        }

        DB::commit();
        return redirect()->route('admin.roles')->with('success', 'Reguistro actualizado correctamente');
    }
}
