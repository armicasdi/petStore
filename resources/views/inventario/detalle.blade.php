@extends('layouts.material')

@section('cssExtra')
    <link rel="stylesheet" href=" {{ asset('css/custom.css') }}">
@endsection

@section('menuLateral')
    @include('inventario.menuLateral')
@endsection

@section('contenido')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-plain">
                <div class="card-header card-header-success">
                    <h4 class="card-title mt-0">Detalles de entrada producto</h4>
                    <p class="card-category">Descripción: {{ $entrada->descripcion }}</p>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="">
                                <td>Cantidad</td>
                                <th>Producto</th>
                                <th>Precio compra</th>
                                <th>Fecha vencimieto</th>
                            </thead>
                            <tbody>
                            @foreach($detalles as $detalle)
                                <tr>
                                    <td>{{ $detalle->cantidad }}</td>
                                    <td>{{ $detalle->productos->nombre }}</td>
                                    <td>$ {{ $detalle->valor }}</td>
                                    <td>{{ date('d/m/Y', strtotime($detalle->fecha_vencimiento)) }}</td>
                                    <td></td>
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
