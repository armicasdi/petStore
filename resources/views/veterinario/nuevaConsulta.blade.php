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
                <div>Fecha de nacimiento: {{ date("d/m/Y", strtotime($mascota->fecha_nac)) }}</div>
                <div>Color: {{ $mascota->Color }}</div>
                <div>Peso: {{ $consulta->peso }} libras</div>
                <div>Temperatura: {{ $consulta->temperatura ? $consulta->temperatura : 'No aplica' }} c</div>
                <div>Frecuencia Cardiaca: {{ $consulta->fr_cardiaca ? $consulta->fr_cardiaca : 'No aplica' }}</div>
                <div>Referido: {{ $consulta->referido ? 'SI ha sido referido' : 'NO ha sido refedido' }}</div>
            </div>
        </div>
    </div>

    <form action="{{ route('veterinario.gconsulta',['cod_consulta'=>$consulta->cod_consulta]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-text card-header-danger">
                        <div class="card-text">
                            <h4 class="card-title">Consulta</h4>
                        </div>
                    </div>
                    <div class="card-body">
                            @include('partials.consulta')
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="cod_expediente" value="{{ $consulta->cod_expediente }}">
        <br>
        <button class="btn btn-info btn-danger">Guardar consulta</button>
    </form>

        {{-- MOSTRAR EL HISTORIAL DE CONSULTAS --}}


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-info">
                    <h4 class="card-title">Historial de consulta</h4>
                </div>
                <div class="card-body">

                    {{-- Inicio de collaps--}}
                    <div id="accordion" role="tablist">
                        @if($historial->count())
                            @foreach($historial as $consulta)
                            <div class="card card-collapse">
                                <div class="card-header" role="tab" id="headingOne">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" class="text-info" href="#collapseOne{{ $consulta->cod_consulta }}" aria-expanded="true" aria-controls="collapseOne">
                                            Fecha: {{ date("d/m/Y h:i:s a", strtotime($consulta->fecha)) }} &nbsp;&nbsp;&nbsp; Peso: {{ $consulta->peso }} libras&nbsp;&nbsp;&nbsp; Temperatura: {{ $consulta->temperatura }} c &nbsp;&nbsp;&nbsp; Fr cardiaca: {{ $consulta->fr_cardiaca }} &nbsp;&nbsp;&nbsp;
                                            <i class="material-icons">keyboard_arrow_down</i>
                                        </a>
                                    </h5>
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

@endsection

@section('jsExtra')
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready( function(){
            CKEDITOR.replace( 'historia');
            CKEDITOR.replace( 'diagnostico');
            CKEDITOR.replace( 'tratamiento');
            CKEDITOR.replace( 'observaciones');
        });
    </script>

    @if(session()->has('success'))
        <script>
            Command: toastr["success"]("{{ session()->get('success') }}", "¡Éxito!")
            @include('partials.message')
        </script>
    @elseif(session()->has('error'))
        <script>
            Command: toastr["error"]("{{ session()->get('error') }}", "¡Error!")
            @include('partials.message')
        </script>
    @endif
@endsection
