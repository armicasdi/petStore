@extends('layouts.material')

@section('menuLateral')
    @include('secretaria.menuLateral')
@endsection

@section('contenido')

    <form action="{{ route('secretaria.gactualizarPropietario',['cod_propietario' => $propietario->cod_propietario]) }}" method="POST" id="formActualizarPropietario">
        @csrf
        @method('PUT')
        @include('partials.propietario')
        <button type="submit" class="btn btn-info mr-5" id="actualizar">Actualizar</button>
        <a  class="btn btn-info" href="{{ route('secretaria.actualizarPropietario') }}"> Cancelar</a>
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
            $("#actualizar").click(function (event) {
                jQuery.validator.addMethod("formato", function (value, element) {
                    return this.optional(element) || /^[a-zA-Z áéíóúñÁÉÍÓÚÑ \s]+$/.test(value);
                }, "Carácter no valido en el campo");

                $("#formActualizarPropietario").validate({
                    rules: {
                        nombresPropietario: {
                            required: true,
                            maxlength: 50,
                            formato: true
                        },
                        apellidosPropietario:{
                            required: true,
                            maxlength: 50,
                            formato: true
                        },
                        direccion:{
                            required: true,
                            minlength: 1,
                            maxlength: 200,
                        },
                        telefono:{
                            required: true,
                            minlength: 9,
                            maxlength: 9,

                        },
                        correo:{
                            email: true,
                            maxlength: 40
                        },
                    },
                });
            });

            // Mascara
            $('#telefono').mask('0000-0000');
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

