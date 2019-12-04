
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
                            <h4 class="card-title ">Proveedores registrados</h4>
                        </div>
                        <div class="col-6 card-title text-right pr-5">
                            <a href="{{ route('proveedor.fagregar') }}"> <i class="fa fa-plus-square fa-lg mr-2"></i>Nuevo proveedor</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-success">
                                <th>Nombre juridico</th>
                                <th>Nombre comercial</th>
                                <th>Telefono</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                                </thead>
                            <tbody>
                            @if(!$proveedores->isEmpty())
                                @foreach($proveedores as $proveedor)
                                    <tr>
                                        <td>{{ $proveedor->nombre_juridico }}</td>
                                        <td>{{ $proveedor->nombre_comercial }}</td>
                                        <td>{{ $proveedor->telefono1 }}</td>
                                        <td>{{ $proveedor->descripcion }}</td>
                                        @if( $proveedor->is_active)
                                            <td>
                                                <a href="#" title="Bloquear" data-toggle="modal" data-target="#bloquear{{ $proveedor->cod_proveedor }}">
                                                   <i class="fa fa-unlock fa-lg text-success" aria-hidden="true"></i>
                                                </a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="bloquear{{ $proveedor->cod_proveedor }}" tabindex="-1" role="dialog" aria-labelledby="bloquearm{{ $proveedor->cod_proveedor }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header text-center">
                                                                <h5 class="modal-title" id="bloquearm{{ $proveedor->cod_proveedor }}">Bloquear proveedor</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Si bloquea el proveedor no podra, no se podra seleccionar para futuras transaciones en el sistema
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                <form action="{{ route('proveedor.bloquear',['cod_proveedor'=>$proveedor->cod_proveedor]) }}" method="POST">
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
                                                    <a href="#" title="Bloquear" data-toggle="modal" data-target="#desbloquear{{ $proveedor->cod_proveedor }}">
                                                        <i class="fa fa-lock fa-lg text-danger" aria-hidden="true"></i>
                                                    </a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="desbloquear{{ $proveedor->cod_proveedor }}" tabindex="-1" role="dialog" aria-labelledby="desbloquearm{{ $proveedor->cod_proveedor }}" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header text-center">
                                                                    <h5 class="modal-title" id="desbloquearm{{ $proveedor->cod_proveedor }}">Desbloquear proveedor</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Si realiza la siguiente acción, el proveedor podrá ser seleccionadado para futuras trasacciones en el sistema
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                    <form action="{{ route('proveedor.bloquear',['cod_proveedor'=>$proveedor->cod_proveedor]) }}" method="POST">
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
                                            <a href="{{ route('proveedor.detalle',(['cod_proveedor'=>$proveedor->cod_proveedor])) }}" title="Mostrar">
                                                <i class="fa fa-eye fa-lg mr-2" aria-hidden="true"></i>
                                            </a>
                                            <a href="{{ route('proveedor.factualizar',(['cod_proveedor'=>$proveedor->cod_proveedor])) }}" title="Editar">
                                                <i class="fa fa-pencil-square fa-lg ml-2 mr-2" aria-hidden="true"></i>
                                            </a>
                                            <a href="#" title="Eliminar" data-toggle="modal" data-target="#eliminar{{ $proveedor->cod_proveedor }}">
                                                <i class="fa fa-trash fa-lg ml-2" aria-hidden="true"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="eliminar{{ $proveedor->cod_proveedor }}" tabindex="-1" role="dialog" aria-labelledby="eliminarm{{ $proveedor->cod_proveedor }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">
                                                            <h5 class="modal-title" id="eliminarm{{ $proveedor->cod_proveedor }}">Eliminar proveedor</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Esta seguro de eliminar el registro del proveedor, si lo hace, ya no tendrá acceso a su información
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('proveedor.eliminar',['cod_proveedor'=>$proveedor->cod_proveedor]) }}" method="POST">
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
                            @endif
                            </tbody>
                        </table>
                        @if($proveedores->isEmpty())
                            <p class="h3">No hay registros</p>
                        @endif
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
