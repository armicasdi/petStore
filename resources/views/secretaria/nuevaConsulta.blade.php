@extends('layouts.material')

@section('menuLateral')
    @include('secretaria.menuLateral')
@endsection

@section('contenido')

    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-text card-header-info">
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

    <form action="{{ route('secretaria.gconsulta') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="peso">Peso</label>
            <input type="text" class="form-control @error('peso') is-invalid @enderror" id="peso" name="peso" value="{{ old('peso') }}">
            @error('peso')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="temperatura">Temperatura</label>
            <input type="text" class="form-control @error('temperatura') is-invalid @enderror" id="temperatura" name="temperatura" value="{{ old('temperarurta') }}">
            @error('temperatura')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="frecuencia">Frecuencia cardiaca (Campo opcional)</label>
            <input type="text" class="form-control @error('fr_cardiaca') is-invalid @enderror" id="frecuencia" name="fr_cardiaca" value="{{ old('fr_cardiaca') }}">
            @error('fr_cardiaca')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="referido">
                        La mascota ha sido referida
                <span class="form-check-sign">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        <br>
        <label for="metodo">Veterinario que atendera la mascota</label>
        <select class="form-control" name="cod_usuario">
            @foreach($veterinarios as $veterinario)
                <option value="{{ $veterinario->cod_usuario }}">{{$veterinario->nombres}} {{ $veterinario->apellidos }}</option>
            @endforeach
        </select>
        <input type="hidden" name="cod_expediente" value="{{ $mascota->cod_expediente }}">
        <br>
        <button class="btn btn-info mr-5">Agregar consulta</button>
        <a  class="btn btn-info" href="{{ route('secretaria.consulta') }}"> Cancelar</a>
    </form>
@endsection
