@extends('layouts.material')

@section('menuLateral')
    @include('inventario.menuLateral')
@endsection

@section('contenido')

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header card-header-success">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Productos en existencia</h4>
                        </div>
                        <div class="col-6 card-title text-right pr-5">
                            <a href="{{ route('producto.fagregar') }}"> <i class="fa fa-plus-square fa-lg mr-2"></i>Agregar</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                            <th>Cantidad</th>
                            <th>Nombre</th>
                            <th>Precio venta</th>
                            <th>Tipo</th>
                            <th>Ubicación</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody>
                            @foreach($productos as $producto)
                                <tr>
                                    <td>{{ $producto->cantidad  }}</td>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>$ {{ $producto->precio}}</td>
                                    <td>{{ $producto->tipo_producto->tipo_producto}}</td>
                                    <td>{{ $producto->bodega->nombre}}</td>
                                    @if( $producto->is_active)
                                        <td>
                                            <a href="#" title="Bloquear" data-toggle="modal" data-target="#bloquear{{ $producto->cod_producto }}">
                                                <i class="fa fa-unlock fa-lg text-success" aria-hidden="true"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="bloquear{{ $producto->cod_producto }}" tabindex="-1" role="dialog" aria-labelledby="bloquearm{{ $producto->cod_producto }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">
                                                            <h5 class="modal-title" id="bloquearm{{ $producto->cod_producto }}">Bloquear producto</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Si bloquea el producto, no podra ser seleccionada para las proximas transacciones en el sistema
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('producto.bloquear',['cod_producto'=>$producto->cod_producto]) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="submit" class="btn btn-success">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End modal--}}
                                        </td>
                                    @else
                                        <td>
                                            <a href="#" title="Bloquear" data-toggle="modal" data-target="#desbloquear{{ $producto->cod_producto }}">
                                                <i class="fa fa-lock fa-lg text-danger" aria-hidden="true"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="desbloquear{{ $producto->cod_producto }}" tabindex="-1" role="dialog" aria-labelledby="desbloquearm{{ $producto->cod_producto }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">
                                                            <h5 class="modal-title" id="desbloquearm{{ $producto->cod_producto }}">Desbloquear producto</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Si realiza la siguiente acción, el resgistro del producto podra ser utilizado para las proximas transacciones del sistema
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('producto.bloquear',['cod_producto'=>$producto->cod_producto]) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="submit" class="btn btn-success">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End modal--}}
                                        </td>
                                    @endif
                                    <td>
                                        <a href="{{ route('producto.factualizar',['cod_producto' => $producto->cod_producto]) }}" title="Editar">
                                            <i class="fa fa-pencil-square fa-lg ml-2 mr-2" aria-hidden="true"></i>
                                        </a>

                                        <a href="#" title="Eliminar" data-toggle="modal" data-target="#eliminar{{ $producto->cod_producto }}">
                                            <i class="fa fa-trash fa-lg ml-2" aria-hidden="true"></i>
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="eliminar{{ $producto->cod_producto }}" tabindex="-1" role="dialog" aria-labelledby="eliminarm{{ $producto->cod_producto }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header text-center">
                                                        <h5 class="modal-title" id="eliminarm{{ $producto->cod_producto }}">Eliminar producto</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Esta seguro de eliminar el registro del producto, si lo hace ya no se podra utilizar para las proximas transacciones
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('producto.eliminar',['cod_producto'=>$producto->cod_producto]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="submit" class="btn btn-danger">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End modal--}}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            {{-- páginación --}}
            <div class="col-md-12">
                {{ $productos->links() }}
            </div>

        </div>
    </div>
@endsection


@section('jsExtra')
    @if(session()->has('success'))
        <script>
            Command: toastr["success"]("{{ session()->get('success') }}", "¡Éxito!")
            @include('partials.message')
        </script>
    @elseif(session()->has('error'))
        <script>
            Command: toastr["error"]("{{ session()->get('error') }}", "¡Error!")
            @include('partials.message')
        </script>
    @endif
@endsection
