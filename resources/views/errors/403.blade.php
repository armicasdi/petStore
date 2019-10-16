@extends('layouts.app')

@section('title','404 - Petfamily')

@section('content')

    <div class="row">
        <div class="col-md-6 ml-auto mr-auto">
            <div class="card card-chart">
                <div class="card-header text-center">
                    <h4>No estas autorizado para acceder</h4>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('img/img_app/403.png') }}" alt="404.png" width="45%">
                    <h4 class="card-title">Esto no es una falla, no tienes los permisos para acceder</h4>
                </div>
            </div>
        </div>
    </div>

@endsection
