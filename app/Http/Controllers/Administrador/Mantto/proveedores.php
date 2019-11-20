<?php

namespace App\Http\Controllers\administrador\mantto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class proveedores extends Controller
{
    //

    public function index()
    {
        $pagActual = 'proveedores';
        $proveedores = \App\Proveedores::all();
        return view('administrador.mantto.proveedores', compact('proveedores','pagActual'));
    }


    public function create()
    {
        $pagActual = 'proveedores';
        return view('administrador.mantto.proveedorAgregar', compact('pagActual'));
    }

}
