
@extends('layouts.material')

@section('menuLateral')
    @include('administrador.menuLateral')
@endsection

@section('contenido')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Información</h4>
                </div>
                @include('partials.informacion')
                <div class="ml-3 mb-3">
                    <a href="{{ route('admin.empleadoActualizar',(['cod_usuario'=> $usuario->cod_usuario])) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ route('admin.empleados') }}" class="btn btn-primary">Regresar</a>
                </div>
            </div>
        </div>
    </div>
    @endsection

