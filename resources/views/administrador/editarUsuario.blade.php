@extends('layouts.material')

@section('menuLateral')
    @include('administrador.menuLateral')
@endsection

@section('contenido')
    <form action="{{ route('admin.empleadoActualizar',(['cod_usuario'=> $empleado->cod_usuario])) }}" method="POST" id="formEmpleado">
        @csrf
        @method('PUT')
        @include('partials.usuario')
        <br>
        <div class="card card-nav-tabs">
            <div class="card-header card-header-primary">
                Usuario
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Usuario</label>
                    <input type="text" class="form-control @error('usuario') is-invalid @enderror" id="exampleFormControlInput1" name="usuario"  value="{{ isset($empleado) ? $empleado->usuario->usuario : old('usuario') }}">
                    @error('usuario')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Tipo de usuario</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="cod_tipo_usuario">
                        @foreach($tipos_usuarios as $tipo_usuario)
                            @if(isset($empleado) && $tipo_usuario->cod_tipo_usuario == $empleado->usuario->cod_tipo_usuario)
                                <option value="{{ $tipo_usuario->cod_tipo_usuario }}" selected> {{ $tipo_usuario->tipo }}</option>
                                @continue
                            @endif
                            <option value="{{ $tipo_usuario->cod_tipo_usuario }}"> {{ $tipo_usuario->tipo }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mr-5" id="guardar">Guardar</button>
        <a  class="btn btn-default" href="{{ route('admin.empleados') }}"> Cancelar</a>
    </form>

@endsection

@section('jsExtra')
    <script src="{{ asset('js/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/validation/jquery.validate.additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/validation/messages_es.js') }}"></script>
    <script src="{{ asset('js/mask/jquery.mask.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            // VALIDACIÓN
            $("#guardar").click(function (event) {
                jQuery.validator.addMethod("formato", function (value, element) {
                    return this.optional(element) || /^[a-zA-Z áéíóúñÁÉÍÓÚÑ \s]+$/.test(value);
                }, "Carácter no valido en el campo");

                $("#formEmpleado").validate({
                    rules: {
                        nombres: {
                            required: true,
                            maxlength: 50,
                            formato: true
                        },
                        apellidos:{
                            required: true,
                            maxlength: 50,
                            formato: true
                        },
                        dui:{
                            required: true,
                            minlength: 10,
                            maxlength: 10,
                        },
                        fech_nac:{
                            required: true,
                            dateISO: true
                        },
                        cod_genero:{
                            required: true,
                            number: true
                        },
                        telefono1:{
                            required: true,
                            minlength: 9,
                            maxlength: 9,
                        },
                        telefono2:{
                            minlength: 9,
                            maxlength: 9,
                        },
                        correo:{
                            email: true,
                            maxlength: 40
                        },
                        direccion:{
                            required: true,
                            maxlength: 200,
                        },
                        usuario:{
                            required: true,
                            formato: true,
                        },
                        cod_tipo_usuario:{
                            required: true,
                            number: true,
                        },
                    },
                });
            });

            // Mascara
            $('#dui').mask('00000000-0');
            $('#telefono1').mask('0000-0000');
            $('#telefono2').mask('0000-0000');
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
    @elseif(session()->has('warning'))
        <script>
            Command: toastr["warning"]("{{ session()->get('warning') }}", "¡Advertencia!")
            @include('partials.message')
        </script>
    @endif

@endsection
