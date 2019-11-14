@extends('layouts.material')

@section('menuLateral')
    @include('administrador.menuLateral')
@endsection

@section('contenido')
    <form action="{{ route('tipoProducto.agregar') }}" method="POST">
        @csrf
        @include('partials.tipoProducto')
        <button type="submit" class="btn btn-primary mr-5">Guardar</button>
        <a class="btn btn-primary" href="{{ route('tiposProductos') }}"> Cancelar</a>
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
