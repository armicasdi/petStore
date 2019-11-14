@extends('layouts.material')

@section('menuLateral')
    @include('administrador.menuLateral')
@endsection

@section('contenido')

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header card-header-primary">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Bodegas registradas</h4>
                        </div>
                        <div class="col-6 card-title text-right pr-5">
                            <a href="{{ route('bodega.fagregar') }}"> <i class="fa fa-plus-square fa-lg mr-2"></i>Agregar</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                            <th>Correlativo</th>
                            <th>bodegas</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody>
                            @foreach($bodegas as $bodega)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $bodega->nombre }}</td>
                                    @if( $bodega->is_active)
                                        <td>
                                            <a href="#" title="Bloquear" data-toggle="modal" data-target="#bloquear{{ $bodega->cod_bodega }}">
                                                <i class="fa fa-unlock fa-lg text-success" aria-hidden="true"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="bloquear{{ $bodega->cod_bodega }}" tabindex="-1" role="dialog" aria-labelledby="bloquearm{{ $bodega->cod_bodega }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">
                                                            <h5 class="modal-title" id="bloquearm{{ $bodega->cod_bodega }}">Bloquear bodega</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Si bloquea la bodega, no podra ser seleccionada para las proximas transacciones en el sistema
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('bodega.bloquear',['cod_bodega'=>$bodega->cod_bodega]) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="submit" class="btn btn-primary">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End modal--}}
                                        </td>
                                    @else
                                        <td>
                                            <a href="#" title="Bloquear" data-toggle="modal" data-target="#desbloquear{{ $bodega->cod_bodega }}">
                                                <i class="fa fa-lock fa-lg text-danger" aria-hidden="true"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="desbloquear{{ $bodega->cod_bodega }}" tabindex="-1" role="dialog" aria-labelledby="desbloquearm{{ $bodega->cod_bodega }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">
                                                            <h5 class="modal-title" id="desbloquearm{{ $bodega->cod_bodega }}">Desbloquear usuario</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Si realiza la siguiente acción, el resgistro de la bodega podra ser utilizado para las proximas transacciones del sistema
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('bodega.bloquear',['cod_bodega'=>$bodega->cod_bodega]) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="submit" class="btn btn-primary">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End modal--}}
                                        </td>
                                    @endif
                                    <td>
                                        <a href="{{ route('bodega.factualizar',['cod_bodega' => $bodega->cod_bodega]) }}" title="Editar">
                                            <i class="fa fa-pencil-square fa-lg ml-2 mr-2" aria-hidden="true"></i>
                                        </a>

                                        <a href="#" title="Eliminar" data-toggle="modal" data-target="#eliminar{{ $bodega->cod_bodega }}">
                                            <i class="fa fa-trash fa-lg ml-2" aria-hidden="true"></i>
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="eliminar{{ $bodega->cod_bodega }}" tabindex="-1" role="dialog" aria-labelledby="eliminarm{{ $bodega->cod_bodega }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header text-center">
                                                        <h5 class="modal-title" id="eliminarm{{ $bodega->cod_bodega }}">Eliminar bodega</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Esta seguro de eliminar el registro de la bodega, si lo hace ya no se podra utilizar para las proximas transacciones
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('bodega.eliminar',['cod_bodega'=>$bodega->cod_bodega]) }}" method="POST">
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
