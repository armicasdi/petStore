
@extends('layouts.material')

@section('menuLateral')
    @include('administrador.menuLateral')
@endsection

@section('contenido')

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Ventas realizadas</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>Identificador</th>
                                <th>Responsable</th>
                                <th>Fecha - Hora</th>
                                <th>Acciones</th>
                                </thead>
                            <tbody>
                                @if(!$ventas->isEmpty())
                                    @foreach($ventas as $venta)
                                        <tr>
                                            <td>{{ $venta->cod_venta }}</td>
                                            <td>{{ $venta->empleado->nombres }} {{ $venta->empleado->apellidos }}</td>
                                            <td>{{ date('d/m/Y h:i:s a',strtotime($venta->fecha)) }}</td>
                                            <td>
                                                <a href="{{ route('admin.ventaDetalle',(['cod_venta'=>$venta->cod_venta])) }}" title="Mostrar">
                                                    <i class="fa fa-eye fa-lg mr-2" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        @if($ventas->isEmpty())
                            <p class="h3">No hay registro de ventas</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endsection
