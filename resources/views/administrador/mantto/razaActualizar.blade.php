@extends('layouts.material')

@section('menuLateral')
    @include('administrador.menuLateral')
@endsection

@section('contenido')
    <form action="{{ route('raza.actualizar', ['cod_raza' => $raza->cod_raza]) }}" method="POST">
        @csrf
        @method('PUT')
        @include('partials.raza')
        <button type="submit" class="btn btn-primary mr-5">Guardar</button>
        <a class="btn btn-primary" href="{{ route('razas') }}"> Cancelar</a>
    </form>

@endsection

@section('jsExtra')
    @if(session()->has('info'))
        <script>
            Command: toastr["info"]("{{ session()->get('info') }}", "¡Advertencia!")
            @include('partials.message')
        </script>
    @endif
@endsection
