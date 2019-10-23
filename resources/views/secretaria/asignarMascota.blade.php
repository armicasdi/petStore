@extends('layouts.material')

@section('menuLateral')
    @include('secretaria.menuLateral')
@endsection

@section('contenido')
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-text card-header-info">
                <div class="card-text">
                    <h4 class="card-title"> {{ $propietario->nombres }} {{ $propietario->apellidos }}</h4>
                </div>
            </div>
            <div class="card-body">
                <div>Direccion: {{ $propietario->direccion }}</div>
                <div>Teléfono: {{ $propietario->telefono }}</div>
                <div>Correo: {{ $propietario->correo }}</div>
            </div>
        </div>
    </div>
    <br>

    <form action="{{ route('secretaria.gactualizar',['cod_propietario'=> $propietario->cod_propietario]) }}" method="POST">
       @include('partials.mascota')
        <button type="submit" class="btn btn-info  mr-5">Guardar</button>
        <a  class="btn btn-info" href="{{ route('secretaria.actualizar') }}"> Cancelar</a>
    </form>

@endsection

@section('jsExtra')
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

