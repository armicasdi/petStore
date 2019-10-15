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
            </div>
        </div>
    </div>

    <form action="{{ route('veterinario.gvacuna',['cod_control_vacunas'=>$vacuna->cod_control_vacunas]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-text card-header-warning">
                        <div class="card-text">
                            <h4 class="card-title">Vacuna</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Tipo: {{ $vacuna->vacunas->vacuna }}</h4>
                        <br>
                        <div class="form-group">
                            <label for="date">Proxima vacuna</label>
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
        <button class="btn btn-info btn-warning">Guardar vacuna</button>
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
