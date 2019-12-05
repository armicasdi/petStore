@extends('layouts.material')

@section('menuLateral')
    @include('administrador.menuLateral')
@endsection

@section('contenido')

    <div class="container">
    <div><img src="{{ asset('img/logo.png') }}" alt="logo.png" style="height: 6rem; width:6rem;" class="logo_dashboard"></div>  <br />

     <div class="row">
      <div class="col-md-7" align="left">
       <h4>Mascotas registradas en el mes de {{ $nombre_mes }}</h4>
       <h4>Generado: {{ date('d-m-Y h:i:s a') }}</h4>
       <h4>Creado por: {{ Auth::user()->empleados->nombres }} {{ Auth::user()->empleados->apellidos }}</h4>
      </div>
      <div class="col-md-5" align="right">
       <a href="{{ route('pdf') }}" class="btn btn-danger" target="_blank">Obtener Reporte</a>
      </div>
     </div>
     <br />
     <div class="table-responsive">
      <table class="table table-bordered table-hover">
       <thead class="thead-dark bold">
        <tr>
         <th><b>Cod Expediente</b></th>
         <th><b>Nombre de la mascota</b></th>
         <th><b> Color </b></th>
         <th><b> Fecha de Creacion</b></th>
        </tr>
       </thead>
       <tbody class="">
       @foreach($customer_data as $customer)
        <tr>
         <td>{{ $customer->cod_expediente }}</td>
         <td>{{ $customer->nombre }}</td>
         <td>{{ $customer->Color }}</td>
         <td>{{ date('d/m/Y', strtotime($customer->fecha_creacion)) }}</td>
        </tr>
       @endforeach
       </tbody>
      </table>
     </div>
    </div>
@endsection
