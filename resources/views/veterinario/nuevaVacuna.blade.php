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
            </div>
        </div>
    </div>

    <form action="{{ route('veterinario.gvacuna',['cod_control_vacunas'=>$vacuna->cod_control_vacunas]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-text card-header-danger">
                        <div class="card-text">
                            <h4 class="card-title">Vacuna</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Tipo: {{ $vacuna->vacunas->vacuna }}</h4>
                        <br>
                        <div class="form-group">
                            <label for="date">Proxima vacuna (campo opcional)</label>
                            <input type="date" class="form-control @error('proxima') is-invalid @enderror" id="date" name="proxima">
                            @error('proxima')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="cod_vacuna" value="{{ $vacuna->vacunas->cod_vacuna}}">
        <br>
        <button class="btn btn-danger mr-5">Guardar vacuna</button>
        <a  href="{{ route('veterinario.vacunas') }}" class="btn btn-default">Cancelar</a>
    </form>


    {{-- MOSTRAR EL HISTORIAL DE VACUNAS --}}


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-info">
                    <h4 class="card-title">Historial de vacunas</h4>
                </div>
                <div class="card-body">

                    {{-- Inicio de collaps--}}
                    <div id="accordion" role="tablist">
                        @if($historial->count())
                            @foreach($historial as $vacuna)
                                <div class="card card-collapse">
                                    <div class="card-header" role="tab" id="headingOne">
                                        <h5 class="mb-0">
                                            <a data-toggle="collapse" class="text-info" href="#collapseOne{{ $vacuna->cod_control_vacunas }}" aria-expanded="true" aria-controls="collapseOne">
                                                Fecha: {{ date("d/m/Y H:i:s", strtotime($vacuna->fecha)) }} &nbsp;&nbsp;&nbsp; Veterinario: {{ $vacuna->empleados->nombres }} {{ $vacuna->empleados->apellidos }} &nbsp;&nbsp;&nbsp;
                                                <i class="material-icons">keyboard_arrow_down</i>
                                            </a>
                                        </h5>
                                    </div>

                                    <div id="collapseOne{{ $vacuna->cod_control_vacunas }}" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                                <div>Tipo: {{ $vacuna->vacunas->vacuna}}</div>
                                                <div>Fecha proxima vacuna: {{ $vacuna->proxima ?? 'No definida'}}</div>
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
