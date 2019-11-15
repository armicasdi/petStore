@extends('layouts.material')

@section('menuLateral')
    @include('administrador.menuLateral')
@endsection

@section('contenido')

    <div class="container">
     <div><img src=" {{ asset('img/logo.png') }}" alt="logo.png" style="height: 6rem; width:6rem;" class="logo_dashboard"></div>  <br />
     
     <div class="row">
      <div class="col-md-7" align="left">
       <h4>Productos más vendidos</h4>
       <h4>Generado: {{ date('d-m-Y h:i:s a') }}</h4>
       <h4>Creado por: {{ Auth::user()->empleados->nombres }} {{ Auth::user()->empleados->apellidos }}</h4>
      </div>
      <div class="col-md-5" align="right">
       <a href="{{ route('pdf2') }}" class="btn btn-danger" target="_blank"><b>Obtener Reporte</b></a>
      </div>
     </div>
     <br />
     <div class="table-responsive">
      <table class="table table-bordered table-hover">
       <thead class="thead-dark bold">
        <tr>
         <th>Nombre</th>
         <th>Precio</th>
         <th>Cantidad</th>
        </tr>
       </thead>
       <tbody>
       @foreach($customer_data as $customer)
        <tr>
         <td>{{ $customer->nombre }}</td>
         <td>$ {{ $customer->precio }}</td>
         <td>{{ $customer->cantidad }}</td>
        </tr>
       @endforeach
       </tbody>
      </table>
     </div>
    </div>
@endsection