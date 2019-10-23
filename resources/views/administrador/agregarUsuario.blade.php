@extends('layouts.material')

@section('menuLateral')
    @include('administrador.menuLateral')
@endsection

@section('contenido')
    <form action="{{ route('admin.gagregar') }}" method="POST">
        @csrf
        @include('partials.usuario')
        <br>
        <div class="card card-nav-tabs">
            <div class="card-header card-header-primary">
                Usuario
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Usuario</label>
                    <input type="text" class="form-control @error('usuario') is-invalid @enderror" id="exampleFormControlInput1" name="usuario"  value="{{ isset($empleado) ? $empleado->usuario : old('usuario') }}">
                    @error('usuario')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Tipo de usuario</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="cod_tipo_usuario">
                        @foreach($tipos_usuario as $tipo_usuario)
                            @if(isset($empleado) && $tipo_usuario->cod_tipo_usuario == $empleado->cod_tipo_usuario)
                                <option value="{{ $tipo_usuario->cod_tipo_usuario }}" selected> {{ $tipo_usuario->tipo }}</option>
                                @continue
                            @endif
                            <option value="{{ $tipo_usuario->cod_tipo_usuario }}"> {{ $tipo_usuario->tipo }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mr-5">Guardar</button>
        <a  class="btn btn-primary" href="{{ route('admin.agregar') }}"> Cancelar</a>
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
    @elseif(session()->has('warning'))
        <script>
            Command: toastr["warning"]("{{ session()->get('warning') }}", "¡Advertencia!")
            @include('partials.message')
        </script>
    @endif

@endsection
