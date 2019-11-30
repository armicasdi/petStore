@extends('layouts.material')

@section('menuLateral')
    @include('inventario.menuLateral')
@endsection

@section('contenido')
    <form action="{{ route('tproducto.agregar') }}" method="POST" id="formTipoProducto">
        @csrf
        @include('partials.tipoProducto')
        <button type="submit" class="btn btn-success mr-5" id="guardar">Guardar</button>
        <a class="btn btn-default" href="{{ route('tipos.productos') }}"> Cancelar</a>
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

                    $("#formTipoProducto").validate({
                        rules: {
                            tipo_producto: {
                                required: true,
                                minlength: 1,
                                maxlength: 50,
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
