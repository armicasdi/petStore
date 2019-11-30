
@extends('layouts.app')

@section('title','409 - Petfamily')

@section('content')

    <div class="row">
        <div class="col-md-6 ml-auto mr-auto">
            <div class="card card-chart">
                <div class="card-header text-center">
                    <h4>Vaya, ocurrrió algo ):</h4>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('img/img_app/query.png') }}" alt="query.png" width="45%">
                    <h4 class="card-title">Esto no es una falla,solo que no se puede eliminar de forma permanente el recurso porque está relacionado con algún otro' </h4>
                </div>
            </div>
        </div>
    </div>

@endsection

