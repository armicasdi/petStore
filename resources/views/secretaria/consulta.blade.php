@extends('layouts.material')

@section('menuLateral')
    @include('secretaria.menuLateral')
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

                <div class="card-header card-header-info">
                    <h4 class="card-title ">Resultados</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-info">
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
                if(anterior != $(this).val()){
                    anterior = $(this).val();
                    if($(this).val().length > 2) {
                        let metodo = $('#metodo').val();
                        let busqueda = $.trim($(this).val());
                        let data = $('#data');
                        if (busqueda != '') {
                            $('#mensaje').html('');
                            $.ajax({
                                type: 'GET',
                                url: "{{ url('secretaria/busqueda') }}/" + metodo + "/" + busqueda,
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
                                                        <a href="{{ route('secretaria.nuevaConsulta') }}/${v.cod_expediente}" title="Consulta" id="consulta">
                                                            <i class="fa fa-user-md fa-2x mr-2" aria-hidden="true"></i>
                                                        </a>
                                                        <a href="{{ route('secretaria.nuevaVacuna') }}/${v.cod_expediente}" title="Vacuna" id="vacuna" >
                                                            <i class="fa fa-suitcase fa-2x mr-2" aria-hidden="true"></i>
                                                        </a>
                                                        <a href="{{ route('secretaria.nuevaPeluqueria') }}/${v.cod_expediente}" title="Peluqueria" id="peluqueria" >
                                                            <i class="fa fa-paw fa-2x" aria-hidden="true"></i>
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
                                                                <a href="{{ route('secretaria.nuevaConsulta') }}/${v.cod_expediente}" title="Consulta" id="consulta" >
                                                                    <i class="fa fa-user-md fa-2x mr-2" aria-hidden="true"></i>
                                                                </a>
                                                                <a href="{{ route('secretaria.nuevaVacuna') }}/${v.cod_expediente}" title="Vacuna" id="vacuna" >
                                                                    <i class="fa fa-suitcase fa-2x mr-2" aria-hidden="true"></i>
                                                                </a>
                                                                <a href="{{ route('secretaria.nuevaPeluqueria') }}/${v.cod_expediente}" title="Peluqueria" id="peluqueria" >
                                                                    <i class="fa fa-paw fa-2x" aria-hidden="true"></i>
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
                    }else{
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
    @elseif(session()->has('warning'))
        <script>
            Command: toastr["info"]("{{ session()->get('warning') }}", "¡Información!")
            @include('partials.message')
        </script>
    @endif

@endsection

