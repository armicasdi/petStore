@extends('layouts.material')

@section('menuLateral')
    @include('secretaria.menuLateral')
@endsection

@section('contenido')

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">

                <div class="card-header card-header-tabs card-header-info">
                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                            <span class="nav-tabs-title">Últimos agregados:</span>
                            <ul class="nav nav-tabs" data-tabs="tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#consulta" data-toggle="tab">
                                        <i class="material-icons">pets</i> Consultas
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#vacunas" data-toggle="tab">
                                        <i class="material-icons">colorize</i> Vacunas
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#peluqueria" data-toggle="tab">
                                        <i class="material-icons">collections_bookmark</i> Peluqueria
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="tab-content">

                        <div class="tab-pane active" id="consulta">
                            <table class="table table-sm">
                                <thead class="text-info">
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Raza</th>
                                    <th>Propietario</th>
                                    <th>Teléfono</th>
                                    <th>Veterinario</th>
                                    <th>Fecha</th>
                                </thead>
                                <tbody>
                                    @foreach($consultas as $consulta)
                                        <tr>
                                            <td>{{ $consulta->mascota->cod_expediente }}</td>
                                            <td>{{ $consulta->mascota->nombre }}</td>
                                            <td>{{ $consulta->mascota->raza->raza }}</td>
                                            <td>{{ $consulta->mascota->propietario->nombres }} {{ $consulta->mascota->propietario->apellidos }}</td>
                                            <td>{{ $consulta->mascota->propietario->telefono }}</td>
                                            <td>{{ $consulta->empleados->nombres }} {{ $consulta->empleados->apellidos }}</td>
                                            <td>{{ date("d/m/Y h:m a", strtotime($consulta->fecha)) }} </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane" id="vacunas">
                            <table class="table table-sm">
                                <thead class="text-info">
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Raza</th>
                                <th>Propietario</th>
                                <th>Teléfono</th>
                                <th>Vacuna</th>
                                <th>Veterinario</th>
                                <th>Fecha</th>
                                </thead>
                                <tbody>
                                @foreach($vacunas as $vacuna)
                                    <tr>
                                        <td>{{ $vacuna->mascota->cod_expediente }}</td>
                                        <td>{{ $vacuna->mascota->nombre }}</td>
                                        <td>{{ $vacuna->mascota->raza->raza }}</td>
                                        <td>{{ $vacuna->mascota->propietario->nombres }} {{ $vacuna->mascota->propietario->apellidos }}</td>
                                        <td>{{ $vacuna->mascota->propietario->telefono }}</td>
                                        <td>{{ $vacuna->vacunas->vacuna }}</td>
                                        <td>{{ $vacuna->empleados->nombres }}</td>
                                        <td>{{ date("d/m/Y h:m a", strtotime($vacuna->fecha)) }} </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>


                        <div class="tab-pane" id="peluqueria">

                            <table class="table table-sm">
                                <thead class="text-info">
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Raza</th>
                                <th>Propietario</th>
                                <th>Teléfono</th>
                                <th>Atendido</th>
                                <th>Fecha</th>
                                </thead>
                                <tbody>
                                @foreach($servicios as $peluqueria)
                                    <tr>
                                        <td>{{ $peluqueria->mascota->cod_expediente }}</td>
                                        <td>{{ $peluqueria->mascota->nombre }}</td>
                                        <td>{{ $peluqueria->mascota->raza->raza }}</td>
                                        <td>{{ $peluqueria->mascota->propietario->nombres }} {{ $peluqueria->mascota->propietario->apellidos }}</td>
                                        <td>{{ $peluqueria->mascota->propietario->telefono }}</td>
                                        <td>{{ $peluqueria->empleados->nombres }}</td>
                                        <td>{{ date("d/m/Y h:m a", strtotime($peluqueria->fecha)) }} </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
