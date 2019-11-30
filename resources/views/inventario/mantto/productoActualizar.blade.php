@extends('layouts.material')

@section('menuLateral')
    @include('inventario.menuLateral')
@endsection

@section('contenido')
    <form action="{{ route('producto.actualizar', ['cod_producto' => $producto->cod_producto]) }}" method="POST" id="formProducto">
        @csrf
        @method('PUT')
        @include('partials.producto')
        <button type="submit" class="btn btn-success mr-5" id="guardar">Guardar</button>
        <a class="btn btn-default" href="{{ route('productos') }}"> Cancelar</a>
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
                    return this.optional(element) || /^(\d+|\d+.\d{1,2})$/.test(value);
                }, "La cantidad ingresada no es valida");

                $("#formProducto").validate({
                    rules: {
                        nombre: {
                            required: true,
                            minlength: 1,
                            maxlength: 45,
                        },
                        precio :{
                            required: true,
                            number: true,
                            formato: true,
                            range: [0.01,1000]
                        },
                        cod_tipo_producto: {
                            required : true
                        }
                    },
                });
            });
        });
    </script>

        @if(session()->has('info'))
            <script>
                Command: toastr["info"]("{{ session()->get('info') }}", "¡Advertencia!")
                @include('partials.message')
            </script>
        @endif
@endsection
