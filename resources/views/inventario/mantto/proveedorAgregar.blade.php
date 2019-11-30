@extends('layouts.material')

@section('menuLateral')
    @include('inventario.menuLateral')
@endsection

@section('contenido')
    <form action="{{ route('proveedor.agregar') }}" method="POST" id="formProveedor">
        @csrf
        @include('partials.proveedor')
        <button type="submit" class="btn btn-success mr-5" id="guardar">Guardar</button>
        <a class="btn btn-default" href="{{ route('proveedores') }}"> Cancelar</a>
    </form>

@endsection

@section('jsExtra')
    <script src="{{ asset('js/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/validation/jquery.validate.additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/validation/messages_es.js') }}"></script>
    <script src="{{ asset('js/mask/jquery.mask.min.js') }}"></script>
    <script>
        $(document).ready(function () {

            $('#telefono1').mask('0000-0000');
            $('#telefono2').mask('0000-0000');

            $("#guardar").click(function (event) {

                $("#formProveedor").validate({
                    rules: {
                        nombre_juridico: {
                            required: true,
                            maxlength: 75,
                        },
                        nombre_comercial:{
                            required: true,
                            maxlength: 45,
                        },
                        direccion:{
                            required: true,
                            maxlength: 200,
                        },
                        telefono1:{
                            required: true,
                            maxlength: 9,
                        },
                        telefono2:{
                            maxlength: 9,
                        },
                        correo:{
                            required: true,
                            email: true,
                            maxlength: 30,
                        },
                        descripcion: {
                            required: true,
                            maxlength: 300,
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
    @endif
@endsection
