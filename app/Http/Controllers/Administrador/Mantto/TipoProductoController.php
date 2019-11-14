<?php

namespace App\Http\Controllers\Administrador\Mantto;

use App\Http\Controllers\Controller;
use App\Tipo_producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipoProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagActual = 'tiposProductos';
        $tipoProductos = Tipo_producto::all();
        return view('administrador.mantto.tiposProductos', compact('tipoProductos','pagActual'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pagActual = 'tiposProductos';
        return view('administrador.mantto.tipoProductoAgregar', compact('pagActual'));
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
            'tipo_producto' => ['required','max:50','string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('tipoProducto.fagregar')
                ->withErrors($validator)
                ->withInput();
        }

        $tipoProduto = new Tipo_producto;
        $tipoProduto->fill([
            'tipo_producto' => $request->tipo_producto,
        ]);

        $success = $tipoProduto->save();

        if(!$success){
            return redirect()->route('tiposProductos')->with('error', 'Error al agrear al registro');
        }

        return redirect()->route('tiposProductos')->with('success', 'Registro agreado correctamente');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cod_tipo_producto)
    {
        $pagActual = 'tiposProductos';
        $tipoProduto = Tipo_producto::findOrFail($cod_tipo_producto);

        return view('administrador.mantto.tipoProductoActualizar', compact('cod_tipo_producto','pagActual'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$cod_tipo_producto )
    {
        $validator = Validator::make($request->all(), [
            'tipo_producto' => ['required','max:50','string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('tipoProducto.factualizar',compact('cod_tipo_producto'))
                ->withErrors($validator)
                ->withInput();
        }

        $tipoProduto = Tipo_producto::findOrFail($cod_tipo_producto);

        if($request->tipo_producto != $tipoProduto->tipo_producto){
            $tipoProduto->tipo_producto = $request->tipo_producto;
        }

        if($tipoProduto->isClean()){
            return redirect()->route('tipoProducto.factualizar',compact('cod_tipo_producto'))->with('error','Debes especificar un valor diferente')->withInput();
        }

        $success = $tipoProduto->save();

        if(!$success){
            return redirect()->route('tipoProducto.factualizar')->with('error', 'Error al agrear al registro');
        }

        return redirect()->route('tiposProductos')->with('success', 'Registro agreado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_tipo_producto)
    {
        $success = Tipo_producto::findOrFail($cod_tipo_producto)->delete();
        if(!$success){
            return redirect()->route('tiposProductos')->with('error', 'Error al eliminar el registro');
        }
        return redirect()->route('tiposProductos')->with('success', 'Reguistro eliminado correctamente');

    }

    public function bloquear($cod_tipo_producto){

        $tipoProduto = Tipo_producto::findOrFail($cod_tipo_producto);
        $tipoProduto->is_active = ! $tipoProduto->is_active;
        $sucess = $tipoProduto->save();
        if(!$sucess){
            return redirect()->route('tiposproductos')->with('error', 'Error al actulizar el registro de la tipo de producto');
        }
        return redirect()->route('tiposProductos')->with('success', 'Reguistro actualizado correctamente');
    }

}
