<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagActual = 'password';
        $usuarios = Usuarios::where('reset_pass',1)->with('empleados','tipo_usuario')->get();
        return view('administrador.passwordReset',compact('usuarios','pagActual'));
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
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'usuario' => ['required', 'max:15', 'string'],
        ]);

        if($validator->fails()){
            return redirect()->route('resetPassword')->withErrors()->withInput();
        }

        $usuario = Usuarios::where('usuario', $request->usuario )->first();

        if(!$usuario){
            return redirect()->back()->withErrors(['usuario'=>'El usuario no esta registrado'])->withInput();
        }

        $usuario->reset_pass = 1;
        $usuario->save();

        return redirect()->route('login')->with('success','Solicitud enviada');
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

    public function cambio($cod_usuario){
        $usuario = Usuarios::findOrFail($cod_usuario);
        $usuario->password = bcrypt('petfamily');
        $usuario->reset_pass = 0;
        $usuario->save();
        return redirect()->route('password.fsolicitudes')->with('success','Se ha reseteo la contraseña del ususario');
    }

    public function cancelar($cod_usuario){
        $usuario = Usuarios::findOrFail($cod_usuario);
        $usuario->reset_pass = 0;
        $usuario->save();
        return redirect()->route('password.fsolicitudes')->with('success','Solicitud cancelada correctamente');
    }
}
