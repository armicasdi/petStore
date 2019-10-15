@extends('layouts.material')

@section('menuLateral')
    @include('peluqueria.menuLateral')
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
                            <th>Expediente</th>
                            <th>Nombre</th>
                            <th>Raza</th>
                            <th>sexo</th>
                            <th>Nombre propietario</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody>
                            @foreach($peluquerias as $peluqueria)
                                <tr>
                                    <td>{{ $peluqueria->cod_expediente }}</td>
                                    <td>{{ $peluqueria->mascota->nombre }}</td>
                                    <td>{{ $peluqueria->mascota->raza->raza }}</td>
                                    <td>{{ $peluqueria->mascota->sexo->sexo }}</td>
                                    <td>{{ $peluqueria->mascota->propietario->nombres}} {{ $peluqueria->mascota->propietario->apellidos  }}</td>
                                    <td>
                                        <a href="{{ route('peluqueria.atenderMascota',['cod_expediente'=>$peluqueria->cod_expediente,'cod_peluqueria'=>$peluqueria->cod_peluqueria]) }}" title="Atender">
                                            <i class="fa fa-files-o fa-2x mr-2" aria-hidden="true"></i>
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
