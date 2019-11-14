@extends('layouts.material')

@section('menuLateral')
    @include('administrador.menuLateral')
@endsection

@section('contenido')
    <form action="{{ route('servicio.actualizar', ['cod_tipo_servicio' => $servicio->cod_tipo_servicio]) }}" method="POST">
        @csrf
        @method('PUT')
        @include('partials.servicio')
        <button type="submit" class="btn btn-primary mr-5">Guardar</button>
        <a class="btn btn-primary" href="{{ route('servicios') }}"> Cancelar</a>
    </form>

@endsection

@section('jsExtra')
    @if(session()->has('error'))
        <script>
            Command: toastr["error"]("{{ session()->get('error') }}", "¡Error!")
            @include('partials.message')
        </script>
    @endif
@endsection
