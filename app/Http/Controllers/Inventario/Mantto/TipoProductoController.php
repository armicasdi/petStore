<?php

namespace App\Http\Controllers\Inventario\Mantto;

use App\Especie;
use App\Http\Controllers\Controller;
use App\Productos;
use App\Tipo_producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $pagActual = 'tipoProducto';
        $tiposProductos = Tipo_producto::orderBy('is_active', 'desc')->paginate(10);
        return view('inventario.mantto.tipoProducto', compact('tiposProductos','pagActual'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pagActual = 'tipoProducto';
        return view('inventario.mantto.tipoProductoAgregar', compact('pagActual'));
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
            'tipo_producto' => ['required','unique:tipo_producto,tipo_producto','max:50','string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('tproducto.fagregar')
                ->withErrors($validator)
                ->withInput();
        }

        $tipo_producto = new Tipo_producto();
        $tipo_producto->fill([
            'tipo_producto' => $request->tipo_producto,
        ]);

        $success = $tipo_producto->save();

        if(!$success){
            return redirect()->route('tipos.productos')->with('error', 'Error al agrear al registro');
        }

        return redirect()->route('tipos.productos')->with('success', 'Registro agreado correctamente');
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
    public function edit($cod_tipo_producto)
    {
        $pagActual = 'tipoProducto';
        $tipo_producto = Tipo_producto::findOrFail($cod_tipo_producto);
        return view('inventario.mantto.tipoProductoActualizar', compact('tipo_producto','pagActual'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_tipo_producto)
    {
        $validator = Validator::make($request->all(), [
            'tipo_producto' => ['required','unique:tipo_producto,tipo_producto','max:50','string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('tproducto.factualizar',compact('cod_tipo_producto'))
                ->withErrors($validator)
                ->withInput();
        }

        $tipo_producto = Tipo_producto::findOrFail($cod_tipo_producto);

        if($request->tipo_producto != $tipo_producto->tipo_producto){
            $tipo_producto->tipo_producto = $request->tipo_producto;
        }

        if($tipo_producto->isClean()){
            return redirect()->route('tproducto.factualizar',compact('cod_tipo_producto'))->with('error','Debes especificar un valor diferente')->withInput();
        }

        $success = $tipo_producto->save();

        if(!$success){
            return redirect()->route('tproducto.factualizar')->with('error', 'Error al agrear al registro');
        }

        return redirect()->route('tipos.productos')->with('success', 'Registro agreado correctamente');
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
            return redirect()->route('tipos.productos')->with('error', 'Error al eliminar el registro');
        }
        return redirect()->route('tipos.productos')->with('success', 'Reguistro eliminado correctamente');

    }

    public function bloquear($cod_tipo_producto){

        $tipoProducto = Tipo_producto::findOrFail($cod_tipo_producto);

        if(!$tipoProducto){
            return redirect()->route('tipos.productos')->with('error', 'El tipo de producto especificado no existe');
        }

        $productos = Productos::where('cod_tipo_producto',$cod_tipo_producto)->get();

        DB::beginTransaction();
        try{
            if($tipoProducto->is_active){
                $tipoProducto->is_active = ! $tipoProducto->is_active;
                $success = $tipoProducto->save();
                if(!$success){
                    DB::rollBack();
                    return redirect()->route('tipos.productos')->with('error', 'Error al actualizar el estado del tipo de producto');
                }
                foreach ($productos as $producto){
                    $producto->temp = $producto->is_active;
                    $producto->is_active = 0;
                    $success = $producto->save();
                    if(!$success){
                        DB::rollBack();
                        return redirect()->route('tipos.productos')->with('error', 'Error al actulizar los productos asignados al tipo de producto');
                    }
                }
            }else {
                $tipoProducto->is_active = ! $tipoProducto->is_active;
                $success = $tipoProducto->save();
                if(!$success){
                    DB::rollBack();
                    return redirect()->route('tipos.productos')->with('error', 'Error al actualizar el estado del tipo de producto');
                }

                foreach ($productos as $producto){
                    $producto->is_active = $producto->temp;
                    $producto->temp = 0;
                    $success = $producto->save();
                    if(!$success){
                        DB::rollBack();
                        return redirect()->route('tipos.productos')->with('error', 'Error al actulizar los productos asignados al tipo de producto');
                    }
                }
            }
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('tipos.productos')->with('error', 'Error al actulizar el registro');
        }

        DB::commit();
        return redirect()->route('tipos.productos')->with('success', 'Registro actualizado correctamente');
    }
}
