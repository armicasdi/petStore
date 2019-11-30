@extends('layouts.material')

@section('menuLateral')
    @include('inventario.menuLateral')
@endsection

@section('contenido')
    <form action="{{ route('ubicacion.agregar') }}" method="POST" id="formUbicacion">
        @csrf
        @include('partials.ubicacion')
        <button type="submit" class="btn btn-success mr-5" id="guardar">Guardar</button>
        <a class="btn btn-default" href="{{ route('ubicaciones') }}"> Cancelar</a>
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
                    return this.optional(element) || /^[a-zA-Z áéíóúñ \s]+$/.test(value);
                }, "Solo texto en el campo");

                $("#formUbicacion").validate({
                    rules: {
                        nombre: {
                            required: true,
                            minlength: 1,
                            maxlength: 45,
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
    @endif
@endsection
