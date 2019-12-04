<?php

namespace App\Http\Controllers\Inventario\Mantto;

use App\Http\Controllers\Controller;
use App\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagActual = 'proveedor';
        $proveedores = Proveedor::orderBy('is_active','desc')->get();
        return view('inventario.mantto.proveedor', compact('proveedores', 'pagActual'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pagActual = 'proveedor';
        return view('inventario.mantto.proveedorAgregar', compact('pagActual'));
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
            'nombre_juridico' => ['required','unique:proveedores,nombre_juridico','max:75','string'],
            'nombre_comercial' => ['required','unique:proveedores,nombre_comercial','max:45','string'],
            'direccion' => ['required','max:200','string'],
            'telefono1' => ['required','max:15','string'],
            'telefono2' => ['max:15'],
            'correo' => ['nullable','unique:proveedores,correo','max:30','email'],
            'descripcion' => ['required','max:300','string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('proveedor.fagregar')
                ->withErrors($validator)
                ->withInput();
        }


        $proveedor = new Proveedor;
        $proveedor->fill([
            'nombre_juridico' => $request->nombre_juridico,
            'nombre_comercial' => $request->nombre_comercial,
            'direccion' => $request->direccion,
            'telefono1' => $request->telefono1,
            'telefono2' => $request->telefono2,
            'correo' => $request->correo,
            'descripcion' => $request->descripcion,
        ]);

        $success = $proveedor->save();

        if(!$success){
            return redirect()->route('proveedores')->with('error', 'Error al agrear al registro');
        }

        return redirect()->route('proveedores')->with('success', 'Registro agreado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cod_provedor)
    {
        $pagActual = 'proveedor';
        $proveedor = Proveedor::findOrFail($cod_provedor);
        return view('inventario.mantto.proveedorDetalle', compact('proveedor', 'pagActual'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cod_proveedor)
    {
        $pagActual = 'proveedor';
        $proveedor = Proveedor::findOrFail($cod_proveedor);
        return view('inventario.mantto.proveedorActualizar', compact('proveedor','pagActual'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_proveedor)
    {
        $validator = Validator::make($request->all(), [
            'nombre_juridico' => ['required','unique:proveedores,nombre_juridico,'. $cod_proveedor.',cod_proveedor','max:75','string'],
            'nombre_comercial' => ['required','unique:proveedores,nombre_comercial,'. $cod_proveedor.',cod_proveedor','max:45','string'],
            'direccion' => ['required','max:200','string'],
            'telefono1' => ['required','max:15','string'],
            'telefono2' => ['max:15'],
            'correo' => ['nullable','unique:proveedores,correo,'. $cod_proveedor.',cod_proveedor','max:30','email'],
            'descripcion' => ['required','max:300','string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('proveedor.factualizar',compact('cod_proveedor'))
                ->withErrors($validator)
                ->withInput();
        }

        $proveedor = Proveedor::findOrFail($cod_proveedor);

        if($request->nombre_juridico != $proveedor->nombre_juridico){
            $proveedor->nombre_juridico = $request->nombre_juridico;
        }

        if($request->nombre_comercial != $proveedor->nombre_comercial){
            $proveedor->nombre_comercial = $request->nombre_comercial;
        }

        if($request->direccion != $proveedor->direccion){
            $proveedor->direccion = $request->direccion;
        }

        if($request->telefono2 != $proveedor->telefono2){
            $proveedor->telefono2 = $request->telefono2 ?? null;
        }

        if($request->telefono1 != $proveedor->telefono1){
            $proveedor->telefono1 = $request->telefono1;
        }

        if($request->correo != $proveedor->correo){
            $proveedor->correo = $request->correo;
        }

        if($request->descripcion != $proveedor->descripcion){
            $proveedor->descripcion = $request->descripcion;
        }

        if($proveedor->isClean()){
            return redirect()->route('proveedor.factualizar',compact('cod_proveedor'))->with('info','Debes especificar un valor diferente')->withInput();
        }

        $success = $proveedor->save();

        if(!$success){
            return redirect()->route('proveedores')->with('error', 'Error al agrear al registro');
        }

        return redirect()->route('proveedores')->with('success', 'Registro actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_proveedor)
    {
        $success = Proveedor::findOrFail($cod_proveedor)->delete();
        if(!$success){
            return redirect()->route('proveedores')->with('error', 'Error al eliminar el registro');
        }
        return redirect()->route('proveedores')->with('success', 'Reguistro eliminado correctamente');
    }

    public function bloquear($cod_proveedor){

        $proveedor = Proveedor::findOrFail($cod_proveedor);
        $proveedor->is_active = ! $proveedor->is_active;
        $sucess = $proveedor->save();
        if(!$sucess){
            return redirect()->route('proveedores')->with('error', 'Error al actulizar el registro del proveedor');
        }
        return redirect()->route('proveedores')->with('success', 'Reguistro actualizado correctamente');
    }
}
