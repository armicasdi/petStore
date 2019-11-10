@extends('layouts.material')

@section('menuLateral')
    @include('administrador.menuLateral')
@endsection

@section('contenido')

    <div class="container">
     <h3 align="center">PetFamily</h3><br />
     
     <div class="row">
      <div class="col-md-7" align="right">
       <h4>Productos más vendidos</h4>
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
         <th>Nombre</th>
         <th>Precio</th>
         <th>Cantidad</th>
        </tr>
       </thead>
       <tbody>
       @foreach($customer_data as $customer)
        <tr>
         <td>{{ $customer->nombre }}</td>
         <td>{{ $customer->precio }}</td>
         <td>{{ $customer->cantidad }}</td>
        </tr>
       @endforeach
       </tbody>
      </table>
     </div>
    </div>
@endsection