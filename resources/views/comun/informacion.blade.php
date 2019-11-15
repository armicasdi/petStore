
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

                <div class="card-body">
                    <p class="card-text">Rol:</p>
                    <p class="card-text">Nombre completo:</p>
                    <p class="card-text">Dui:</p>
                    <p class="card-text">Edad:</p>
                    <p class="card-text">Género:</p>
                    <p class="card-text">Telefono 1:</p>
                    <p class="card-text">Telefono 2:</p>
                    <p class="card-text">Correo:</p>
                    <p class="card-text">Dirección:</p>
                </div>

            </div>
        </div>
    </div>
    @endsection

