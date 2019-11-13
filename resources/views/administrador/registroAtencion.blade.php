
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
                <a href="{{ route('pdf2') }}" class="btn btn-danger">Obtener Reporte</a>
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
                @foreach($data as $customer)
                    <tr>
                        <td>{{ $customer->peso }}</td>
                        <td>{{ $customer->mascota->nombre }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
