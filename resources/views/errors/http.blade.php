
@extends('layouts.app')

@section('title','404 - Petfamily')

@section('content')

    <div class="row">
        <div class="col-md-6 ml-auto mr-auto">
            <div class="card card-chart">
                <div class="card-header text-center">
                    <h4>Vaya, ocurrrió algo :(</h4>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('img/img_app/http.png') }}" alt="http.png" width="45%">
                    <h4 class="card-title">Mensaje: {{ $mensaje }}</h4>
                </div>
            </div>
        </div>
    </div>

@endsection

