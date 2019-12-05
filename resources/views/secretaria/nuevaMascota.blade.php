@extends('layouts.material')

@section('menuLateral')
    @include('secretaria.menuLateral')
@endsection

@section('contenido')

    <form>
        @csrf
        <div class="form-group">
            <label for="busqueda">Nombre del propietario:</label>
            <input type="text" class="form-control" id="busqueda" name="busqueda" required>
            <div><label id="mensaje"></label></div>
        </div>
    </form>

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header card-header-info">
                    <h4 class="card-title ">Resultados</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-info">
                            <th>Nombre propietario</th>
                            <th>Teléfono</th>
                            <th>Direccion</th>
                            <th>Accion</th>
                            </thead>
                            <tbody id="data">
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
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

            $("#busqueda").keypress(function(event) {
                if(event.which == 13) {
                    event.preventDefault();
                }
            });

            var anterior = '';
            // Traer la raza la especie seleccionada
            $('#busqueda').change( function (event) {
                if(anterior != $(this).val()) {
                    anterior = $(this).val();
                    if ($(this).val().length > 2) {
                        let busqueda = $.trim($(this).val());
                        let data = $('#data');
                        if (busqueda != '') {
                            console.log('si');
                            $('#mensaje').html('');
                            $.ajax({
                                type: 'GET',
                                url: "{{ url('secretaria/busqueda') }}/3/" + busqueda,
                                async: false,
                                success: function (respuesta) {
                                    console.log(respuesta);
                                    let html = "";
                                    if (respuesta.tipo == 3) {
                                        $(respuesta.data).each(function (k, a) {
                                            html += `<tr>
                                                            <td>${a.nombres} ${a.apellidos}</td>
                                                            <td>${a.telefono}</td>
                                                            <td>${a.direccion}</td>
                                                            <td>
                                                                <a href="{{ route('secretaria.asignar') }}/${a.cod_propietario}" title="AgregarMascota" id="consulta" >
                                                                    <i class="fa fa-plus-square fa-2x mr-2" aria-hidden="true"></i>
                                                                </a>
                                                            </td>
                                                    </tr>`
                                        });
                                        data.empty().html(html);
                                    } else {
                                        data.empty().html('<p class="h3">No hay resultados</p>');
                                    }
                                },
                                error: function (respuesta) {
                                    console.dir(respuesta);
                                }
                            });
                        } else {
                            data.empty().html('<p class="h3">No hay resultados</p>');
                            $('#mensaje').html('<p class="text-danger">Compo requerido</p>')
                        }
                    } else {
                        $("#data").empty().html('<p class="h3">No hay resultados</p>');
                    }
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

