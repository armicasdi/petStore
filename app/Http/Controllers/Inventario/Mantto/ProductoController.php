<?php

namespace App\Http\Controllers\Inventario\Mantto;

use App\Http\Controllers\Controller;
use App\Productos;
use App\Tipo_producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagActual = 'producto';
        $productos = Productos::orderBy('is_active','desc')->with(['bodega'=>function($consulta){
            $consulta->withTrashed()->get();
        },'tipo_producto'=>function($consulta){
               $consulta->withTrashed()->get();
        }])->paginate(10);

        return view('inventario.mantto.producto', compact('productos','pagActual'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pagActual = 'producto';
        $tiposProductos = Tipo_producto::where('is_active',1)->get();
        return view('inventario.mantto.productoAgregar', compact('tiposProductos','pagActual'));
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
            'nombre' => ['required','unique:productos,nombre','max:45','string'],
            'precio' => ['required','max:45','string'],
            'cod_tipo_producto' => ['required','integer'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('producto.fagregar')
                ->withErrors($validator)
                ->withInput();
        }

        $producto = new Productos();
        $producto->fill([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'cod_tipo_producto' => $request->cod_tipo_producto,
            'cantidad' => 0,
            'cod_bodega' => 1,
        ]);

        $success = $producto->save();

        if(!$success){
            return redirect()->route('productos')->with('error', 'Error al agrear al registro');
        }

        return redirect()->route('productos')->with('success', 'Registro agreado correctamente');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cod_producto)
    {
        $pagActual = 'producto';
        $producto = Productos::findOrFail($cod_producto);
        $tiposProductos = Tipo_producto::all();
        return view('inventario.mantto.productoActualizar', compact('producto','tiposProductos','pagActual'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $cod_raza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_producto)
    {

        $validator = Validator::make($request->all(), [
            'nombre' => ['required','unique:productos,nombre,'.$cod_producto .',cod_producto','max:45','string'],
            'precio' => ['required','max:45','string'],
            'cod_tipo_producto' => ['required','integer'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('producto.factualizar',compact('cod_producto'))
                ->withErrors($validator)
                ->withInput();
        }

        $producto = Productos::findOrFail($cod_producto);

        if($request->nombre != $producto->nombre){
            $producto->nombre = $request->nombre;
        }

        if($request->precio != $producto->precio){
            $producto->precio = $request->precio;
        }

        if($request->cod_tipo_producto != $producto->cod_tipo_producto){
            $producto->cod_tipo_producto = $request->cod_tipo_producto;
        }

        if($producto->isClean()){
            return redirect()->route('producto.factualizar',compact('cod_producto'))->with('info','Debes especificar un valor diferente')->withInput();
        }

        $success = $producto->save();

        if(!$success){
            return redirect()->route('productos')->with('error', 'Error al agrear al registro');
        }

        return redirect()->route('productos')->with('success', 'Registro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_producto)
    {
        $success = Productos::findOrFail($cod_producto)->delete();
        if(!$success){
            return redirect()->route('productos')->with('error', 'Error al eliminar el registro');
        }
        return redirect()->route('productos')->with('success', 'Reguistro eliminado correctamente');
    }


    public function bloquear($cod_producto){

        $producto = Productos::findOrFail($cod_producto);
        $producto->is_active = ! $producto->is_active;
        $sucess = $producto->save();
        if(!$sucess){
            return redirect()->route('productos')->with('error', 'Error al actulizar el registro de la raza');
        }
        return redirect()->route('productos')->with('success', 'Reguistro actualizado correctamente');
    }
}
