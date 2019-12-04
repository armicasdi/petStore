@extends('layouts.material')

@section('cssExtra')
    <link rel="stylesheet" href=" {{ asset('css/custom.css') }}">
@endsection

@section('menuLateral')
    @include('administrador.menuLateral')
@endsection

@section('contenido')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-plain">
                <div class="card-header card-header-primary">
                    <h4 class="card-title mt-0">Detalles de venta de productos</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="text-primary">
                                <th>Cantidad</th>
                                <th>Producto</th>
                                <th>Precio compra</th>
                                <th>Subtotal</th>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach($detalles as $detalle)
                                    <tr>
                                        <td>{{ $detalle->cantidad }}</td>
                                        <td>{{ $detalle->producto->nombre }}</td>
                                        <td>$ {{ $detalle->valor }}</td>
                                        <td>$ {{ $detalle->cantidad * $detalle->valor }}</td>
                                        @php
                                            $total +=  $detalle->cantidad * floor($detalle->valor * 100)
                                        @endphp
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-header card-header-primary w-25">
                    <h4 class="card-title mt-0">Total: $<?php echo($total/100); ?></h4>
                </div>

            </div>
        </div>
    </div>

@endsection
