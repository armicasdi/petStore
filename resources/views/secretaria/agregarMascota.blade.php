@extends('layouts.material')

@section('menuLateral')
    @include('secretaria.menuLateral')
@endsection

@section('contenido')

    <form action="{{ route('secretaria.gmascota') }}" method="POST">
        @csrf
        @include('partials.propietario')
        <br>
       @include('partials.mascota')
        <button type="submit" class="btn btn-info">Guardar</button>
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

