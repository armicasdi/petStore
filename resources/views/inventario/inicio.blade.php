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
                    <h4 class="card-title mt-0">Últimas entrada de prodcutos</h4>
                    <p class="card-category">Detalles de las últimas de entrada de producto al inventario</p>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="">
                                <td>N Factura</td>
                                <th class="w-50">Descripcion</th>
                                <th>Responsable</th>
                                <th>Fecha - Hora</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                            @if(!$productos->isEmpty())
                                @foreach($productos as $producto)
                                    <tr>
                                        <td>{{ $producto->nfactura }}</td>
                                        <td>{{ $producto->descripcion }}</td>
                                        <td>{{ $producto->empleados->nombres }} {{ $producto->empleados->apellidos }}</td>
                                        <td>{{ date('d/m/Y H:m:s a', strtotime($producto->fecha)) }}</td>
                                        <td>
                                            <a href="{{ route('entrada.detalle',(['cod_entrada'=>$producto->cod_entrada])) }}" title="Detalles">
                                                <i class="fa fa-eye fa-lg mr-2" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <div class="text-secondary h4"> No hay registros</div>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
