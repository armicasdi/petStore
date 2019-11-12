@extends('layouts.material')

@section('menuLateral')
    @include('administrador.menuLateral')
@endsection

@section('contenido')

    <div class="container">
     <h3 align="center">PetFamily</h3><br />
     
     <div class="row">
      <div class="col-md-7" align="right">
       <h4>Mascotas registradas en el mes de {{ $nombre_mes }}</h4>
       <h4>Generado: {{ date('d-m-Y h:i:s a') }}</h4>
       <h4>Creado por: {{ Auth::user()->empleados->nombres }} {{ Auth::user()->empleados->apellidos }}</h4>
      </div>
      <div class="col-md-5" align="right">
       <a href="{{ route('pdf') }}" class="btn btn-danger">Obtener Reporte</a>
      </div>
     </div>
     <br />
     <div class="table-responsive">
      <table class="table table-striped table-bordered">
       <thead>
        <tr>
         <th>Cod Expediente</th>
         <th>Nombre de la mascota</th>
         <th>Color</th>
         <th>Creado</th>
        </tr>
       </thead>
       <tbody>
       @foreach($customer_data as $customer)
        <tr>
         <td>{{ $customer->cod_expediente }}</td>
         <td>{{ $customer->nombre }}</td>
         <td>{{ $customer->Color }}</td>
         <td>{{ date('Y-m-d', strtotime($customer->fecha_creacion)) }}</td>
        </tr>
       @endforeach
       </tbody>
      </table>
     </div>
    </div>
@endsection