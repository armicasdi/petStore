@extends('layouts.material')

@section('menuLateral')
    @include('veterinario.menuLateral')
@endsection

@section('contenido')

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">pets</i>
                    </div>
                    <h3 class="card-title">{{ $mAtender }}
                        <small>mascotas</small>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Por atender
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">check_box</i>
                    </div>
                    <h3 class="card-title">{{ $mAtendidas }}
                        <small>mascotas</small>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">date_range</i> Atendidadas en este mes
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">work</i>
                    </div>
                    <h3 class="card-title">{{ $vAtender }}
                        <small>mascotas</small>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">local_offer</i> Por vacunar
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">done_outline</i>
                    </div>
                    <h3 class="card-title">{{ $vAtendidas }}
                        <small>mascotas</small>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">local_offer</i> Vacunadas en este mes
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header card-header-danger">
                    <h4 class="card-title ">Últimas consultas atendidas</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-danger">
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Raza</th>
                                <th>sexo</th>
                                <th>Nombre propietario</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                                @if(!$consultas->isEmpty())
                                    @foreach($consultas as $consulta)
                                        <tr>
                                            <td>{{ $consulta->cod_expediente }}</td>
                                            <td>{{ $consulta->mascota->nombre }}</td>
                                            <td>{{ $consulta->mascota->raza->raza }}</td>
                                            <td>{{ $consulta->mascota->sexo->sexo }}</td>
                                            <td>{{ $consulta->mascota->propietario->nombres}} {{ $consulta->mascota->propietario->apellidos  }}</td>
                                            <td>
                                                <a href="{{ route('veterinario.feditar',['cod_consulta'=>$consulta->cod_consulta]) }}" title="Editar">
                                                    <i class="fa fa-pencil-square fa-2x mr-2" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        @if($consultas->isEmpty())
                            <p class="h3">No hay registros</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
