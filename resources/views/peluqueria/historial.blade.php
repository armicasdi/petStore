@extends('layouts.material')

@section('menuLateral')
    @include('peluqueria.menuLateral')
@endsection

@section('contenido')
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-text card-header-warning">
                <div class="card-text">
                    <h4 class="card-title"> {{ $mascota->nombre }}</h4>
                </div>
            </div>
            <div class="card-body">
                <div>Raza: {{ $mascota->raza->raza }}</div>
                <div>Sexo: {{ $mascota->sexo->sexo }}</div>
                <div>Color: {{ $mascota->Color }}</div>
                <div>Fecha de nacimiento: {{ date("d/m/Y", strtotime($mascota->fecha_nac)) }}</div>
                <div>Propietario: {{ $mascota->propietario->nombres }}  {{ $mascota->propietario->apellidos }}</div>
                <div>Telefono: {{ $mascota->propietario->telefono }}</div>
            </div>
        </div>
    </div>



    {{-- MOSTRAR EL HISTORIAL DE PELUQUERIA --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-warning">
                    <h4 class="card-title">Historial de peluqueria</h4>
                </div>
                <div class="card-body">

                    {{-- Inicio de collaps--}}
                    <div id="accordion3" role="tablist">
                        @if($peluqueria->count())
                            @foreach($peluqueria as $servicio)
                                <div class="card card-collapse">
                                    <div class="card-header" role="tab" id="headingOne">
                                        <h5 class="mb-0">
                                            <a data-toggle="collapse" class="text-info" href="#collapseThree{{ $servicio->cod_peluqueria }}" aria-expanded="true" aria-controls="collapseThree">
                                                Fecha: {{ date("d/m/Y h:i:s a", strtotime($servicio->fecha)) }} &nbsp;&nbsp;&nbsp;
                                                <i class="material-icons">keyboard_arrow_down</i>
                                            </a>
                                        </h5>
                                    </div>

                                    <div id="collapseThree{{ $servicio->cod_peluqueria }}" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion3">
                                        <div class="card-body">
                                            <div>
                                                <div class="text-info">Peluquero:</div>
                                                <p>{{ $servicio->empleados->nombres }} {{ $servicio->empleados->apellidos }}</p>
                                            </div>
                                            <div>
                                                <div class="text-info">Servicios:</div>
                                                <ul>
                                                    @foreach($servicio->detalle_peluqueria as $detalle)
                                                        <li>{{ $detalle->tipo_servicio->servicio }}</li>
                                                    @endforeach
                                                </ul>
                                                <p>Observación: {{$servicio->observaciones ?? 'Ningúna' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h3>No hay registros</h3>
                        @endif
                    </div>
                    {{--End collaps--}}

                </div>
            </div>
        </div>
    </div>

@endsection

