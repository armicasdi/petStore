@extends('layouts.material')

@section('menuLateral')
    @include('secretaria.menuLateral')
@endsection

@section('contenido')

    <form action="{{ route('secretaria.gmascota') }}" method="POST" id="formAgregarMascota">
        @csrf
        @include('partials.propietario')
        <br>
       @include('partials.mascota')
        <button type="submit" class="btn btn-info mr-5" id="guardar">Guardar</button>
        <a  class="btn btn-default" href="{{ route('secretaria.crear') }}"> Cancelar</a>

    </form>

@endsection

@section('jsExtra')
    <script src="{{ asset('js/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/validation/jquery.validate.additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/validation/messages_es.js') }}"></script>
    <script src="{{ asset('js/mask/jquery.mask.min.js') }}"></script>
    <script>
        $(document).ready(function (){
            // Agregar el token en la solicitud ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            // Traer la raza la especie seleccionada
            $('#especie').change( function () {
                let especie = $(this).val();
                $.ajax({
                    type: 'get',
                    url: "{{ url('razas') }}/" + especie,
                    async: false,
                    success:function(respuesta){
                        console.log(respuesta);
                        if(respuesta.length){
                            let html = "";
                            $(respuesta).each(function(k,v){
                                html += `
                                    <option value="${v.cod_raza}">${v.raza}</option>
                                    `;
                            })
                            $('#raza').empty().append(html);
                        }else{
                            $("#raza").empty().append('<option value="" selected>No hay razas registradas o no han sido habilitadas </option>');
                        }
                    },
                    error: function(respuesta){
                        console.log(respuesta);
                    }
                });
            });

            $("#raza").change(function (event){
                let raza = $(this).val();
                let mestizo = $("#mestizo");
                let tipo = $("#tipo");
                //Compara el valor seleccionado (cod asignado en la DB)
                if(raza == 29 || raza == 30 ){
                    mestizo.fadeIn(1000);
                }else{
                    tipo.val('');
                    mestizo.fadeOut(1000);
                }

            });

            // VALIDACIÓN
            $("#guardar").click(function (event) {
                jQuery.validator.addMethod("formato", function (value, element) {
                    return this.optional(element) || /^[a-zA-Z áéíóúñÁÉÍÓÚÑ \s]+$/.test(value);
                }, "Carácter no valido en el campo");

                jQuery.validator.addMethod("snumeros", function (value, element) {
                    return this.optional(element) || /^\d+$/.test(value);
                }, "Selecciona una opción de la lista");

                $("#formAgregarMascota").validate({
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
                        nombreMascota:{
                            required: true,
                            maxlength: 30,
                            formato: true,

                        },
                        fechaNacimiento:{
                            required: true,
                            dateISO: true,
                        },
                        color:{
                            required: true,
                            formato: true,
                            maxlength: 40
                        },
                        sexo:{
                            required: true,
                            number: true,
                        },
                        especie:{
                            required: true,
                            snumeros: true,
                        },
                        raza:{
                            required: true,
                            snumeros: true,
                        },
                        tipo:{
                            formato: true,
                            maxlength: 100,
                        }
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

