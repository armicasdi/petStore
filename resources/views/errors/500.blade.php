
@extends('layouts.app')

@section('title','404 - Petfamily')

@section('content')

    <div class="row">
        <div class="col-md-6 ml-auto mr-auto">
            <div class="card card-chart">
                <div class="card-header text-center">
                    <h4>Vaya, parece que el servidor no responde :(</h4>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('img/img_app/500.png') }}" alt="500.png" width="45%">
                    <h4 class="card-title">Espera un mometo y luego intenta de nuevo</h4>
                    <p class="text-gray">Nota: Si pasa mucho tiempo sin responder contacta al administrador del sistema</p>
                </div>
            </div>
        </div>
    </div>

@endsection

