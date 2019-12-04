@extends('layouts.material')

@section('menuLateral')
    @include('administrador.menuLateral')
@endsection

@section('contenido')
    <form action="{{ route('admin.urol', ['cod_tipo_usuario' => $rol->cod_tipo_usuario]) }}" method="POST" id="formRol">
        @csrf
        @method('PUT')
        <div class="card card-nav-tabs">
            <div class="card-header card-header-primary">
                Editar rol
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="vacuna">Rol</label>
                    <input type="text" class="form-control @error('tipo') is-invalid @enderror" id="tipo" name="tipo"  value="{{ isset($rol) ? $rol->tipo : old('tipo') }}">
                    @error('tipo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mr-5" id="guardar">Guardar</button>
        <a class="btn btn-default" href="{{ route('admin.roles') }}"> Cancelar</a>
    </form>

@endsection

@section('jsExtra')
    <script src="{{ asset('js/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/validation/jquery.validate.additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/validation/messages_es.js') }}"></script>
    <script src="{{ asset('js/mask/jquery.mask.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            // VALIDACIÓN
            $("#guardar").click(function (event) {
                jQuery.validator.addMethod("formato", function (value, element) {
                    return this.optional(element) || /^[a-zA-Z áéíóúñÁÉÍÓÚÑ \s]+$/.test(value);
                }, "Carácter no valido en el campo");

                $("#formRol").validate({
                    rules: {
                        tipo: {
                            required: true,
                            maxlength: 30,
                            formato: true
                        },
                    },
                });
            });
        });
    </script>

    @if(session()->has('error'))
        <script>
            Command: toastr["error"]("{{ session()->get('error') }}", "¡Error!")
            @include('partials.message')
        </script>
    @elseif(session()->has('info'))
        <script>
            Command: toastr["info"]("{{ session()->get('info') }}", "¡Información!")
            @include('partials.message')
        </script>
    @endif

@endsection
