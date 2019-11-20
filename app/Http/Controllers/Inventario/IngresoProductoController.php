<?php

namespace App\Http\Controllers\Inventario;

use App\Http\Controllers\Controller;
use App\Tipo_producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class IngresoProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagActual= 'ingreso';
        $proveedor = $this->traer_proveedor();
        $tipo = $this->traer_tipo_producto();
        return view('inventario.ingresoproducto', compact('pagActual', 'proveedor', 'tipo'));


    }
    public function traer_proveedor(){
          $proveedor = DB::table('proveedores')
        ->select('*')
        ->orderBy('cod_proveedor', 'asc')
        ->where('is_active','=',0)
        ->get();
        return $proveedor;
    }

    public function traer_tipo_producto(){
        $tipoProducto = Tipo_producto::all();
        return $tipoProducto;


    }

    public function ingresar_producto(Request $request){
        $datos=array(
        array('cantida'=> $request->get('cantidad'), 'valor'=> $request->get('precio'), 'fecha_vencimiento'=> $request->get('fechav'))

        );
        $query_insert = DB::table('detalles_entrada')->insert($datos);
    return redirect('inventario.ingreso');


    Model::insert($datos);
    DB::table('detalles_entrada')->insert($datos);
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
