
@extends('layouts.material')

@section('menuLateral')
    @include('inventario.menuLateral')
@endsection

@section('contenido')

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header card-header-success">
                    <h4 class="card-title ">{{ $proveedor->nombre_juridico }} - {{ $proveedor->nombre_comercial }}</h4>
                </div>
                <div class="card-body">
                    <div class="text-gray mb-2">Descripción: {{ $proveedor->descripcion }}</div>
                    <div class="text-gray mb-2">Telefono 1: {{ $proveedor->telefono1 }} </div>
                    <div class="text-gray mb-2">Telefono 2: {{ $proveedor->telefono2 ?? '---- ----' }}</div>
                    <div class="text-gray mb-2">Correo: {{ $proveedor->correo}}</div>
                    <div class="text-gray mb-2">Dirección: {{ $proveedor->direccion }} </div>
                </div>

            </div>
        </div>
    </div>

    @endsection


