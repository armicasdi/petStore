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
                            <h4 class="card-title">Tipos de productos</h4>
                        </div>
                        <div class="col-6 card-title text-right pr-5">
                            <a href="{{ route('tproducto.fagregar') }}"> <i class="fa fa-plus-square fa-lg mr-2"></i>Agregar</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                            <th>Identificador</th>
                            <th>Tipo producto</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody>
                            @foreach($tiposProductos as $tipoProducto)
                                <tr>
                                    <td>{{ $tipoProducto->cod_tipo_producto  }}</td>
                                    <td>{{ $tipoProducto->tipo_producto }}</td>
                                    @if( $tipoProducto->is_active)
                                        <td>
                                            <a href="#" title="Bloquear" data-toggle="modal" data-target="#bloquear{{ $tipoProducto->cod_tipo_producto }}">
                                                <i class="fa fa-unlock fa-lg text-success" aria-hidden="true"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="bloquear{{ $tipoProducto->cod_tipo_producto }}" tabindex="-1" role="dialog" aria-labelledby="bloquearm{{ $tipoProducto->cod_tipo_producto }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">
                                                            <h5 class="modal-title" id="bloquearm{{ $tipoProducto->cod_tipo_producto }}">Bloquear tipo de producto</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Si bloquea el tipo de producto, no podra ser seleccionada para las proximas transacciones en el sistema
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('tproducto.bloquear',['cod_tipo_producto'=>$tipoProducto->cod_tipo_producto]) }}" method="POST">
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
                                            <a href="#" title="Bloquear" data-toggle="modal" data-target="#desbloquear{{ $tipoProducto->cod_tipo_producto }}">
                                                <i class="fa fa-lock fa-lg text-danger" aria-hidden="true"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="desbloquear{{ $tipoProducto->cod_tipo_producto }}" tabindex="-1" role="dialog" aria-labelledby="desbloquearm{{ $tipoProducto->cod_tipo_producto }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">
                                                            <h5 class="modal-title" id="desbloquearm{{ $tipoProducto->cod_tipo_producto }}">Desbloquear tipo de producto</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Si realiza la siguiente acción, el resgistro del tipo de producto podra ser utilizado para las proximas transacciones del sistema
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('tproducto.bloquear',['cod_tipo_producto'=>$tipoProducto->cod_tipo_producto]) }}" method="POST">
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
                                        <a href="{{ route('tproducto.factualizar',['cod_tipo_producto' => $tipoProducto->cod_tipo_producto]) }}" title="Editar">
                                            <i class="fa fa-pencil-square fa-lg ml-2 mr-2" aria-hidden="true"></i>
                                        </a>

                                        <a href="#" title="Eliminar" data-toggle="modal" data-target="#eliminar{{ $tipoProducto->cod_tipo_producto }}">
                                            <i class="fa fa-trash fa-lg ml-2" aria-hidden="true"></i>
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="eliminar{{ $tipoProducto->cod_tipo_producto }}" tabindex="-1" role="dialog" aria-labelledby="eliminarm{{ $tipoProducto->cod_tipo_producto }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header text-center">
                                                        <h5 class="modal-title" id="eliminarm{{ $tipoProducto->cod_tipo_producto }}">Eliminar tipo de producto</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Esta seguro de eliminar el registro del tipo de producto, si lo hace ya no se podra utilizar para las proximas transacciones
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('tproducto.eliminar',['cod_tipo_producto'=>$tipoProducto->cod_tipo_producto]) }}" method="POST">
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
                {{ $tiposProductos->links() }}
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
