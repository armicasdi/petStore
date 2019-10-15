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
