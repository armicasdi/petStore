@extends('layouts.material')

@section('menuLateral')
    @include('administrador.menuLateral')
@endsection

@section('contenido')
    <form action="{{ route('raza.actualizar', ['cod_raza' => $raza->cod_raza]) }}" method="POST" id="formRaza">
        @csrf
        @method('PUT')
        @include('partials.raza')
        <button type="submit" class="btn btn-primary mr-5" id="guardar">Guardar</button>
        <a class="btn btn-default" href="{{ route('razas') }}"> Cancelar</a>
    </form>

@endsection

@section('jsExtra')
    <script src="{{ asset('js/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/validation/jquery.validate.additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/validation/messages_es.js') }}"></script>
    <script>
        $(document).ready(function () {

            $("#guardar").click(function (event) {
                jQuery.validator.addMethod("formato", function (value, element) {
                    return this.optional(element) || /^[a-zA-Z áéíóúñÁÉÍÓÚÑ \s]+$/.test(value);
                }, "Carácter no valido en el campo");

                $("#formRaza").validate({
                    rules: {
                        raza: {
                            required: true,
                            maxlength: 50,
                            formato: true
                        },
                        cod_especie:{
                            required: true,
                            number: true
                        }
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
            Command: toastr["info"]("{{ session()->get('info') }}", "¡Advertencia!")
            @include('partials.message')
        </script>
    @endif
@endsection
