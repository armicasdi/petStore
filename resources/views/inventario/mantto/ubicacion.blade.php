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
                            <h4 class="card-title">Ubicaciones para los productos</h4>
                        </div>
                        <div class="col-6 card-title text-right pr-5">
                            <a href="{{ route('ubicacion.fagregar') }}"> <i class="fa fa-plus-square fa-lg mr-2"></i>Agregar</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                            <th>Correlativo</th>
                            <th>Tipo producto</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody>
                            @foreach($ubicaciones as $ubicacion)
                                <tr>
                                    <td>{{ $ubicacion->cod_bodega  }}</td>
                                    <td>{{ $ubicacion->nombre }}</td>
                                    @if( $ubicacion->is_active)
                                        <td>
                                            <a href="#" title="Bloquear" data-toggle="modal" data-target="#bloquear{{ $ubicacion->cod_bodega }}">
                                                <i class="fa fa-unlock fa-lg text-success" aria-hidden="true"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="bloquear{{ $ubicacion->cod_bodega }}" tabindex="-1" role="dialog" aria-labelledby="bloquearm{{ $ubicacion->cod_bodega }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">
                                                            <h5 class="modal-title" id="bloquearm{{ $ubicacion->cod_bodega }}">Bloquear ubicación</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Si bloquea el tipo de ubicación, no podra ser seleccionada para las proximas transacciones en el sistema
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('ubicacion.bloquear',['cod_bodega'=>$ubicacion->cod_bodega]) }}" method="POST">
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
                                            <a href="#" title="Bloquear" data-toggle="modal" data-target="#desbloquear{{ $ubicacion->cod_bodega }}">
                                                <i class="fa fa-lock fa-lg text-danger" aria-hidden="true"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="desbloquear{{ $ubicacion->cod_bodega }}" tabindex="-1" role="dialog" aria-labelledby="desbloquearm{{ $ubicacion->cod_bodega }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">
                                                            <h5 class="modal-title" id="desbloquearm{{ $ubicacion->cod_bodega }}">Desbloquear ubicación</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Si realiza la siguiente acción, el resgistro de ubicación podra ser utilizado para las proximas transacciones del sistema
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('ubicacion.bloquear',['cod_bodega'=>$ubicacion->cod_bodega]) }}" method="POST">
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
                                        <a href="{{ route('ubicacion.factualizar',['cod_bodega' => $ubicacion->cod_bodega]) }}" title="Editar">
                                            <i class="fa fa-pencil-square fa-lg ml-2 mr-2" aria-hidden="true"></i>
                                        </a>

                                        <a href="#" title="Eliminar" data-toggle="modal" data-target="#eliminar{{ $ubicacion->cod_bodega }}">
                                            <i class="fa fa-trash fa-lg ml-2" aria-hidden="true"></i>
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="eliminar{{ $ubicacion->cod_bodega }}" tabindex="-1" role="dialog" aria-labelledby="eliminarm{{ $ubicacion->cod_bodega }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header text-center">
                                                        <h5 class="modal-title" id="eliminarm{{ $ubicacion->cod_bodega }}">Eliminar ubicación</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Esta seguro de eliminar el registro de ubicación, si lo hace ya no se podra utilizar para las proximas transacciones
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('ubicacion.eliminar',['cod_bodega'=>$ubicacion->cod_bodega]) }}" method="POST">
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
                {{ $ubicaciones->links() }}
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
