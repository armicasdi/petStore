
@extends('layouts.app')

@section('title','405 - Petfamily')

@section('content')

    <div class="row">
        <div class="col-md-6 ml-auto mr-auto">
            <div class="card card-chart">
                <div class="card-header text-center">
                    <h4>Vaya, parece que estas perdido</h4>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('img/img_app/method.png') }}" alt="method.png" width="45%">
                    <h4 class="card-title">Esto no es una falla, solo que el método especificado en la peticion no es valido</h4>
                </div>
            </div>
        </div>
    </div>

@endsection

