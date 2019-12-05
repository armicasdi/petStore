@extends('layouts.material')

@section('menuLateral')
    @include('peluqueria.menuLateral')
@endsection
@section('contenido')

    <form>
        @csrf
        <div class="form-group">
            <label for="metodo">Método de busqueda</label>
            <select class="form-control" id="metodo" name="metodo">
                <option value="2">Nombre</option>
                <option value="3">Propietario</option>
                <option value="1">Código</option>
            </select>
        </div>
        <br>
        <div class="form-group">
            <input type="text" class="form-control" id="busqueda" name="busqueda" aria-describedby="emailHelp" required>
            <div><label id="mensaje"></label></div>
        </div>
    </form>

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header card-header-warning">
                    <h4 class="card-title ">Resultados</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-warning">
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Raza</th>
                                <th>Propietario</th>
                                <th>Teléfono</th>
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

            $('#metodo').change(function () {
                $('#busqueda').val('');
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
                        let metodo = $('#metodo').val();
                        let busqueda = $.trim($(this).val());
                        let data = $('#data');
                        if (busqueda != '') {
                            $('#mensaje').html('');
                            $.ajax({
                                type: 'GET',
                                url: "{{ url('peluqueria/busqueda') }}/" + metodo + "/" + busqueda,
                                async: false,
                                success: function (respuesta) {
                                    let html = "";
                                    if (respuesta.tipo == 1 || respuesta.tipo == 2) {
                                        $(respuesta.data).each(function (k, v) {
                                            html += `
                                                <tr>
                                                    <td>${v.cod_expediente}</td>
                                                    <td>${v.nombre}</td>
                                                    <td>${v.raza.raza}</td>
                                                    <td>${v.propietario.nombres} ${v.propietario.apellidos}</td>
                                                    <td>${v.propietario.telefono}</td>
                                                    <td>
                                                        <a href="{{ route('peluqueria.historial') }}/${v.cod_expediente}" title="Historial" id="consulta">
                                                            <i class="fa fa-eye fa-2x mr-2" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            `;
                                        });
                                        data.empty().html(html);
                                    } else if (respuesta.tipo == 3) {
                                        $(respuesta.data).each(function (k, a) {
                                            $(a.mascota).each(function (k, v) {
                                                html += `<tr>
                                                            <td>${v.cod_expediente}</td>
                                                            <td>${v.nombre}</td>
                                                            <td>${v.raza.raza}</td>
                                                            <td>${a.nombres} ${a.apellidos}</td>
                                                            <td>${a.telefono}</td>
                                                            <td>
                                                                <a href="{{ route('peluqueria.historial') }}/${v.cod_expediente}" title="Historial" id="consulta" >
                                                                    <i class="fa fa-eye fa-2x mr-2" aria-hidden="true"></i>
                                                                </a>
                                                            </td>
                                                    </tr>`
                                            });
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

@endsection

