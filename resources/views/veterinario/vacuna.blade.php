@extends('layouts.material')

@section('menuLateral')
    @include('veterinario.menuLateral')
@endsection

@section('contenido')
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header card-header-danger">
                    <h4 class="card-title ">Vacunas</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-danger">
                            <th>Expediente</th>
                            <th>Nombre</th>
                            <th>Raza</th>
                            <th>sexo</th>
                            <th>Nombre propietario</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody>
                            @foreach($vacunas as $vacuna)
                                <tr>
                                    <td>{{ $vacuna->cod_expediente }}</td>
                                    <td>{{ $vacuna->mascota->nombre }}</td>
                                    <td>{{ $vacuna->mascota->raza->raza }}</td>
                                    <td>{{ $vacuna->mascota->sexo->sexo }}</td>
                                    <td>{{ $vacuna->mascota->propietario->nombres}} {{ $vacuna->mascota->propietario->apellidos  }}</td>
                                    <td>
                                        <a href="{{ route('veterinario.atenderVacuna',['cod_expediente'=>$vacuna->cod_expediente,'cod_control_vacunas'=>$vacuna->cod_control_vacunas]) }}" title="Atender">
                                            <i class="fa fa-user-md fa-2x mr-2" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('jsExtra')
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
