@extends('layouts.material')

@section('menuLateral')
    @include('veterinario.menuLateral')
@endsection

@section('contenido')
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-text card-header-danger">
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

        {{-- MOSTRAR EL HISTORIAL DE CONSULTAS --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-danger">
                    <h4 class="card-title">Historial de consulta</h4>
                </div>
                <div class="card-body">

                    {{-- Inicio de collaps--}}
                    <div id="accordion" role="tablist">
                        @if($consultas->count())
                            @foreach($consultas as $consulta)
                            <div class="card card-collapse">
                                <div class="card-header" role="tab" id="headingOne">
                                    <div class="row">
                                        <div class="col-10">
                                            <h5 class="mb-0">
                                                <a data-toggle="collapse" class="text-info" href="#collapseOne{{ $consulta->cod_consulta }}" aria-expanded="true" aria-controls="collapseOne">
                                                    Fecha: {{ date("d/m/Y h:i:s a", strtotime($consulta->fecha)) }} &nbsp;&nbsp;&nbsp; Peso: {{ $consulta->peso }} libras&nbsp;&nbsp;&nbsp; Temperatura: {{ $consulta->temperatura }} c &nbsp;&nbsp;&nbsp; Fr cardiaca: {{ $consulta->fr_cardiaca }} &nbsp;&nbsp;&nbsp;
                                                    <i class="material-icons">keyboard_arrow_down</i>
                                                </a>
                                            </h5>
                                        </div>
                                        <div class="col-2">
                                            <a href="{{ route('veterinario.feditar',['cod_consulta'=>$consulta->cod_consulta]) }}" title="Editar">
                                                <i class="fa fa-pencil-square fa-2x mr-2" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>

                                <div id="collapseOne{{ $consulta->cod_consulta }}" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <div>
                                            <div class="text-info">Veterinario</div>
                                            <p>{{ $consulta->empleados->nombres }} {{ $consulta->empleados->apellidos }}</p>
                                        </div>
                                        <div>
                                            <div class="text-info">Historia clinica</div>
                                            <p>{!! $consulta->historia_clinica !!}</p>
                                        </div>
                                        <div>
                                            <div class="text-info">Diagnostico</div>
                                            <p>{!!  $consulta->diagnostico !!}</p>
                                        </div>
                                        <div>
                                            <div class="text-info">Tratamiento</div>
                                            <p>{!! $consulta->tratamiento !!}</p>
                                        </div>
                                        <div>
                                            <div class="text-info">Observaciones</div>
                                            <p>{!! $consulta->observaciones !!}</p>
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

    {{-- MOSTRAR EL HISTORIAL DE VACUNAS --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-danger">
                    <h4 class="card-title">Historial de vacunas</h4>
                </div>
                <div class="card-body">

                    {{-- Inicio de collaps--}}
                    <div id="accordion2" role="tablist">
                        @if($vacunas->count())
                            @foreach($vacunas as $vacuna)
                                <div class="card card-collapse">
                                    <div class="card-header" role="tab" id="headingOne">
                                        <h5 class="mb-0">
                                            <a data-toggle="collapse" class="text-info" href="#collapseOne{{ $vacuna->cod_control_vacunas }}" aria-expanded="true" aria-controls="collapseOne">
                                                Fecha: {{ date("d/m/Y h:i:s a", strtotime($vacuna->fecha)) }} &nbsp;&nbsp;&nbsp; Vacuna: {{ $vacuna->vacunas->vacuna }}  &nbsp;&nbsp;&nbsp;
                                                <i class="material-icons">keyboard_arrow_down</i>
                                            </a>
                                        </h5>
                                    </div>

                                    <div id="collapseOne{{ $vacuna->cod_control_vacunas }}" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion2">
                                        <div class="card-body">
                                            <div>
                                                <div class="text-info">Veterinario</div>
                                                <p>{{ $vacuna->empleados->nombres }} {{ $vacuna->empleados->apellidos }}</p>
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

    {{-- MOSTRAR EL HISTORIAL DE PELUQUERIA --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-danger">
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
                                            <a data-toggle="collapse" class="text-info" href="#collapseOne{{ $servicio->cod_peluqueria }}" aria-expanded="true" aria-controls="collapseOne">
                                                Fecha: {{ date("d/m/Y h:i:s a", strtotime($servicio->fecha)) }} &nbsp;&nbsp;&nbsp;
                                                <i class="material-icons">keyboard_arrow_down</i>
                                            </a>
                                        </h5>
                                    </div>

                                    <div id="collapseOne{{ $servicio->cod_peluqueria }}" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion3">
                                        <div class="card-body">
                                            <div>
                                                <div class="text-info">Peluquero:</div>
                                                <p>{{ $servicio->empleados->nombres }} {{ $vacuna->empleados->apellidos }}</p>
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

