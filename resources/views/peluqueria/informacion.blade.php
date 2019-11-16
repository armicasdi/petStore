
@extends('layouts.material')

@section('menuLateral')
    @include('peluqueria.menuLateral')
@endsection

@section('contenido')

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header card-header-warning">
                    <h4 class="card-title ">Información</h4>
                </div>
                @include('partials.informacion')

            </div>
        </div>
    </div>
    @endsection

