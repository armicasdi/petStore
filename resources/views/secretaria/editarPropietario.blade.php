@extends('layouts.material')

@section('menuLateral')
    @include('secretaria.menuLateral')
@endsection

@section('contenido')

    <form action="{{ route('secretaria.gactualizarPropietario',['cod_propietario' => $propietario->cod_propietario]) }}" method="POST">
        @csrf
        @method('PUT')
        @include('partials.propietario')
        <button type="submit" class="btn btn-info mr-5">Actualizar</button>
        <a  class="btn btn-info" href="{{ route('secretaria.actualizarPropietario') }}"> Cancelar</a>
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

