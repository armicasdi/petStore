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
        <button class="btn btn-info btn-danger mr-5">Guardar consulta</button>
    </form>


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
