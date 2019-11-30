<?php

namespace App\Http\Controllers\Inventario;

use App\Detalle_entrada;
use App\Entrada_producto;
use App\Http\Controllers\Controller;
use App\Productos;
use App\Proveedor;
use App\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagActual = 'entrada';
        $proveedores = Proveedor::where('is_active',1)->get();
        $productos = Productos::where('is_active',1)->get();
        return view('inventario.entradaProducto', compact('proveedores','productos','pagActual'));
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
            'nfactura' => ['required','min:1','max:8','string'],
            'descripcion' => ['required','min:1','max:150','string'],
            'cod_proveedor' => ['required'],
            'data' => ['required'],
        ];

        $validar = Validator::make($request->all(),$entrada);

        if($validar->fails()){
            return response()->json(["data"=>"Error, la informacion enviada  no cumple con el formato esperado o no hay detalle de compra", "code" => 409],409);
        }

        $entrada_producto = new Entrada_producto;

        DB::beginTransaction();
            $entrada_producto->fill([
                'descripcion' => $request->descripcion,
                'cod_proveedor' => $request->cod_proveedor,
                'cod_usuario' => Auth::user()->cod_usuario,
                'nfactura' => $request->nfactura,
            ]);

            $success = $entrada_producto->save();

            if(!$success){
                DB::rollBack();
                return response()->json(["data"=>"Error al ingresar el registro de la entrada de producto", "code"=>409],409);
            }

            foreach ($request->data as $detalle){
                $detalle_entrada = new Detalle_entrada;

                $detalle_entrada->fill([
                    'cantidad' => $detalle['cantidad'],
                    'valor' => $detalle['valor'],
                    'fecha_vencimiento' => $detalle['fecha_vencimiento'],
                    'cod_entrada' => $entrada_producto->cod_entrada,
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
                $producto->cantidad += $detalle['cantidad'];
                $producto->save();
            }
            DB::commit();
            return response()->json(["data"=>"Entrada de productos ingresada correctamente", "code"=>200],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cod_entrada)
    {
        $pagActual = "dashboard";
        $detalles = Detalle_entrada::where('cod_entrada',$cod_entrada)->with(['productos'=>function($consulta){
            $consulta->withTrashed()->get();
        }])->get();
        if($detalles->isEmpty()){
            return redirect()->back();
        }
        $entrada = Entrada_producto::findOrFail($detalles->first()->cod_entrada);
        return view('inventario.detalle', compact('detalles','entrada','pagActual'));
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
