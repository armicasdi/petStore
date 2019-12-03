@extends('layouts.material')

@section('menuLateral')
    @include('secretaria.menuLateral')
@endsection

@section('contenido')

    <form action="{{ route('secretaria.gactualizarMascota',['cod_expediente' => $mascota->cod_expediente]) }}" method="POST" id="formEditarMascota">
        @csrf
        @method('PUT')
        @include('partials.mascota')
        <button type="submit" class="btn btn-info mr-5" id="actualizar">Actualizar</button>
        <a  class="btn btn-info" href="{{ route('secretaria.actualizarMascota') }}"> Cancelar</a>
    </form>

@endsection

@section('jsExtra')
    <script src="{{ asset('js/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/validation/jquery.validate.additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/validation/messages_es.js') }}"></script>
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
                        let html = "";
                        $(respuesta).each(function(k,v){
                            html += `
                                <option value="${v.cod_raza}">${v.raza}</option>
                                `;
                        })
                        $('#raza').empty().append(html);
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
            $("#actualizar").click(function (event) {
                jQuery.validator.addMethod("formato", function (value, element) {
                    return this.optional(element) || /^[a-zA-Z áéíóúñÁÉÍÓÚÑ \s]+$/.test(value);
                }, "Carácter no valido en el campo");

                $("#formEditarMascota").validate({
                    rules: {
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
                            maxlength: 40
                        },
                        sexo:{
                            required: true,
                            number: true,
                        },
                        especie:{
                            required: true,
                            number: true,
                        },
                        raza:{
                            required: true,
                            number: true,
                        },
                        tipo:{
                            formato: true,
                            maxlength: 100,
                        }
                    },
                });
            });

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
