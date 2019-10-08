<?php

namespace App\Http\Controllers;

use App\cliente;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class clienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$clientes
        $clientes = Cliente::all();
//        foreach ($clientes as $cliente){
//            echo $cliente->nombres . '<br>';
//
//            foreach ($cliente->mascotas as $mascota){
//                echo $mascota->nombre .'<br>';
//            }
//
//
//
//        }
        return response()->json($clientes, 200);




    }

    public function register(Request $request){
        echo "Accion de Registro";
    }

    public function login(Request $request){
        echo "Accion de Login";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param cliente $cliente
     * @return Response
     */
    public function show(cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param cliente $cliente
     * @return Response
     */
    public function edit(cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param cliente $cliente
     * @return Response
     */
    public function update(Request $request, cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param cliente $cliente
     * @return Response
     */
    public function destroy(cliente $cliente)
    {
        //
    }
}
