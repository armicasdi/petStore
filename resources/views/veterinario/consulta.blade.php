@extends('layouts.material')

@section('menuLateral')
    @include('veterinario.menuLateral')
@endsection

@section('contenido')
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header card-header-warning">
                    <h4 class="card-title ">Consultas</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-warning">
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Raza</th>
                            <th>sexo</th>
                            <th>Nombre propietario</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody>
                            @foreach($consultas as $consulta)
                                <tr>
                                    <td>{{ $consulta->cod_expediente }}</td>
                                    <td>{{ $consulta->mascota->nombre }}</td>
                                    <td>{{ $consulta->mascota->raza->raza }}</td>
                                    <td>{{ $consulta->mascota->sexo->sexo }}</td>
                                    <td>{{ $consulta->mascota->propietario->nombres}} {{ $consulta->mascota->propietario->apellidos  }}</td>
                                    <td>
                                        <a href="{{ route('veterinario.atender',['cod_expediente'=>$consulta->cod_expediente,'cod_consulta'=>$consulta->cod_consulta]) }}" title="Atender">
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
