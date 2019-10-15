@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-6 ml-auto mr-auto">
            <div class="card card-chart">
                <div class="card-header text-center">
                    <h4>Perfil bloqueado</h4>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('img/img_app/lock.png') }}" alt="404.png" width="50%">
                    <h4 class="card-title">Esto no es una falla, tu perfil ha sido bloqueado por seguridad</h4>
                    <h4 class="card-title">Contacta al administrador para habilitarlo</h4>
                </div>
            </div>
        </div>
    </div>

@endsection
