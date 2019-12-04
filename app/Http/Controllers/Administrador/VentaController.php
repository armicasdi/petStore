<?php

namespace App\Http\Controllers\Administrador;

use App\Detalle_entrada;
use App\Detalle_venta;
use App\Entrada_producto;
use App\Http\Controllers\Controller;
use App\Venta;
use Illuminate\Http\Request;

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
        $ventas = Venta::orderBy('fecha','desc')->with('empleado')->paginate(10);
        return view('administrador.venta', compact('ventas','pagActual'));
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
    public function show($cod_venta)
    {

        $pagActual = 'venta';
        $detalles = Detalle_venta::where('cod_venta',$cod_venta)->with(['producto'=>function($consulta){
            $consulta->withTrashed()->get();
        }])->get();
        if($detalles->isEmpty()){
            return redirect()->back();
        }
        return view('administrador.detalleVenta', compact('detalles','pagActual'));

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
