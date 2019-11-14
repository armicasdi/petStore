
@extends('layouts.material')

@section('menuLateral')
    @include('administrador.menuLateral')
@endsection

@section('contenido')

    <div class="container">
        <h3 align="center">PetFamily</h3><br />

        <div class="row">
            <div class="col-md-7" align="right">
                <h4>Reporte de Atencion</h4>
                <h4>Generado: {{ date('d-m-Y h:i:s a') }}</h4>
                <h4>Creado por: {{ Auth::user()->empleados->nombres }} {{ Auth::user()->empleados->apellidos }}</h4>
            </div>
            <div class="col-md-5" align="right">
                <a href="{{ route('admin.reporteAtenciones', ['servicio' => $servicio, 'mes'=> $mes, 'year'=> $year, 'semana'=>$semana]) }}" class="btn btn-danger">Obtener Reporte</a>
            </div>
        </div>
        <br />
        <div class="table-responsive">
            <h3>Servicio: {{$servicio}}</h3>

            <h3>Atendidos: {{count($data)}} </h3>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Codigo </th>
                    <th>Nombre</th>
                    <th>Raza</th>
                    <th>Fecha</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $customer)
                    <tr>
                        <td>{{ $customer->cod_expediente }}</td>
                        <td>{{ $customer->mascota->nombre }}</td>
                        <td>{{ $customer->mascota->raza->raza }}</td>

                        <td>{{date('d-m-Y', strtotime($customer->fecha))}}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
