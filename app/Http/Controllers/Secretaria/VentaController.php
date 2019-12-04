<?php

namespace App\Http\Controllers\Secretaria;

use App\Detalle_entrada;
use App\Detalle_venta;
use App\Entrada_producto;
use App\Http\Controllers\Controller;
use App\Productos;
use App\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagActual = 'venta';
        $productos = Productos::where('is_active',1)->where('disponible',1)->get();
        return view('secretaria.venta', compact('productos','pagActual'));
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
        $entrada = [
            'data' => ['required'],
        ];

        $validar = Validator::make($request->all(),$entrada);

        if($validar->fails()){
            return response()->json(["data"=>"Error, no hay detalle de venta", "code" => 409],409);
        }

        $venta = new Venta();

        DB::beginTransaction();
        $venta->fill([
            'cod_usuario' => Auth::user()->cod_usuario,
        ]);

        $success = $venta->save();

        if(!$success){
            DB::rollBack();
            return response()->json(["data"=>"Error al ingresar el registro de la venta", "code"=>409],409);
        }

        foreach ($request->data as $detalle){
            $detalle_entrada = new Detalle_venta();

            $detalle_entrada->fill([
                'cantidad' => $detalle['cantidad'],
                'valor' => $detalle['valor'],
                'cod_venta' => $venta->cod_venta,
                'cod_producto' => $detalle['cod_producto'],
            ]);
            $success = $detalle_entrada->save();
            if(!$success){
                DB::rollBack();
                return response()->json(["data"=>"Error al ingresar el detalle de cada producto", "code"=>409],409);
            }

            $producto = Productos::find($detalle['cod_producto']);
            if(!$producto){
                DB::rollBack();
                return response()->json(["data"=>"No se puede actualizar el stock de un producto", "code"=>409],409);
            }

            if($producto->cantidad < $detalle['cantidad']){
                DB::rollBack();
                return response()->json(["data"=>"No se puede actualizar el stock del producto {$producto->nombre}, la cantidad a extraer({$detalle['cantidad']}) es mayor a la existente({$producto->cantidad})", "code"=>409],409);
            }

            $producto->cantidad -= $detalle['cantidad'];
            $producto->save();
            if($producto->cantidad == 0){
                $producto->disponible = 0;
                $producto->save();
            }

        }
        DB::commit();
        return response()->json(["data"=>"Venta de productos ingresada correctamente", "code"=>200],200);
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

    public function precio($cod_producto){
        $producto = Productos::findOrFail($cod_producto);
        if(!$producto){
            return response()->json(0,409);
        }
        return response()->json($producto->precio, 200);
    }
}
