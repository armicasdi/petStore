@extends('layouts.material')

@section('menuLateral')
    @include('veterinario.menuLateral')
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
                <div>Fecha de nacimiento: {{ date("d/m/Y", strtotime($mascota->fecha_nac)) }}</div>
                <div>Color: {{ $mascota->Color }}</div>
                <div>Peso: {{ $consulta->peso }} libras</div>
                <div>Temperatura: {{ $consulta->temperatura }} c</div>
                <div>Frecuencia Cardiaca: {{ $consulta->fr_cardiaca }}</div>
            </div>
        </div>
    </div>

    <form action="{{ route('veterinario.gconsulta',['cod_consulta'=>$consulta->cod_consulta]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-text card-header-warning">
                        <div class="card-text">
                            <h4 class="card-title">Consulta</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="historia">Historia clinica</label>
                            <textarea class="form-control @error('historia_clinica') is-invalid @enderror" id="historia" rows="3" name="historia_clinica">{{ old('historia_clinica') }}</textarea>
                            @error('historia_clinica')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="diagnostico">Diagnostico</label>
                            <textarea class="form-control @error('diagnostico') is-invalid @enderror" id="diagnostico" rows="3" name="diagnostico">{{ old('diagnostico') }}</textarea>
                            @error('diagnostico')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tratamiento">Tratamiento</label>
                            <textarea class="form-control @error('tratamiento') is-invalid @enderror" id="tratamiento" rows="3" name="tratamiento">{{ old('tratamiento') }}</textarea>
                            @error('tratamiento')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="observaciones">Observaciones</label>
                            <textarea class="form-control @error('observaciones') is-invalid @enderror" id="observaciones" rows="3" name="observaciones">{{ old('observaciones') }}</textarea>
                            @error('observaciones')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="cod_expediente" value="{{ $consulta->cod_expediente }}">
        <br>
        <button class="btn btn-info btn-warning">Guardar consulta</button>
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
                                            Fecha: {{ date("d/m/Y H:i:s", strtotime($consulta->fecha)) }} &nbsp;&nbsp;&nbsp; Peso: {{ $consulta->peso }} libras&nbsp;&nbsp;&nbsp; Temperatura: {{ $consulta->temperatura }} c &nbsp;&nbsp;&nbsp; Fr cardiaca: {{ $consulta->fr_cardiaca }} &nbsp;&nbsp;&nbsp;
                                            <i class="material-icons">keyboard_arrow_down</i>
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapseOne{{ $consulta->cod_consulta }}" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <div>
                                            <div>Veterinario</div>
                                            <p>{{ $consulta->empleados->nombres }} {{ $consulta->empleados->apellidos }}</p>
                                        </div>
                                        <div>
                                            <div>Historia clinica</div>
                                            <p>{{ $consulta->historia_clinica }}</p>
                                        </div>
                                        <div>
                                            <div>Diagnostico</div>
                                            <p>{{ $consulta->diagnostico }}</p>
                                        </div>
                                        <div>
                                            <div>Tratamiento</div>
                                            <p>{{ $consulta->tratamiento }}</p>
                                        </div>
                                        <div>
                                            <div>Observaciones</div>
                                            <p>{{ $consulta->observaciones }}</p>
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
