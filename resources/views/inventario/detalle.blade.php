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
                            <thead class="text-success">
                            <th>Cantidad</th>
                            <th>Producto</th>
                            <th>Fecha vencimieto</th>
                            <th>Precio compra</th>
                            <th>Subtotal</th>
                            </thead>
                            @php
                                $total = 0;
                            @endphp
                            @foreach($detalles as $detalle)
                                <tr>
                                    <td>{{ $detalle->cantidad }}</td>
                                    <td>{{ $detalle->productos->nombre }}</td>
                                    <td>{{ date('d/m/Y', strtotime($detalle->fecha_vencimiento)) }}</td>
                                    <td>$ {{ $detalle->valor }}</td>
                                    <td>$ {{ $detalle->cantidad * $detalle->valor }}</td>
                                    @php
                                        $total +=  $detalle->cantidad * floor($detalle->valor * 100)
                                    @endphp
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="card-header card-header-success w-25">
                    <h4 class="card-title mt-0">Total: $<?php echo($total/100); ?></h4>
                </div>

            </div>
        </div>
    </div>

@endsection
