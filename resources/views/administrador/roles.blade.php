
@extends('layouts.material')

@section('menuLateral')
    @include('administrador.menuLateral')
@endsection

@section('contenido')

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Roles existentes</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                                </thead>
                            <tbody>
                                @foreach($roles as $rol)
                                    <tr>
                                        <td>{{ $rol->tipo }}</td>

                                        @if( $rol->isActive)
                                            <td>
                                                <a href="#" title="Bloquear" data-toggle="modal" data-target="#bloquear{{ $rol->cod_tipo_usuario }}">
                                                   <i class="fa fa-unlock fa-2x text-success" aria-hidden="true"></i>
                                                </a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="bloquear{{ $rol->cod_tipo_usuario }}" tabindex="-1" role="dialog" aria-labelledby="bloquearm{{ $rol->cod_tipo_usuario }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header text-center">
                                                                <h5 class="modal-title" id="bloquearm{{ $rol->cod_tipo_usuario }}">Bloquear rol</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Si bloquea el rol, los usuarios asignados ha este no podran ingresar a sus funciones
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <form action="{{ route('admin.bloquearRol',['cod_tipo_usuario'=>$rol->cod_tipo_usuario]) }}" method="POST">
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
                                                    <a href="#" title="Bloquear" data-toggle="modal" data-target="#desbloquear{{ $rol->cod_tipo_usuario }}">
                                                        <i class="fa fa-lock fa-2x text-danger" aria-hidden="true"></i>
                                                    </a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="desbloquear{{ $rol->cod_tipo_usuario }}" tabindex="-1" role="dialog" aria-labelledby="desbloquearm{{ $rol->cod_tipo_usuario }}" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header text-center">
                                                                    <h5 class="modal-title" id="desbloquearm{{ $rol->cod_tipo_usuario }}">Desbloquear rol</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Si desbloquea el rol, los usuarios asignados ha este podran ingresar a sus funciones
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                    <form action="{{ route('admin.bloquearRol',['cod_tipo_usuario'=>$rol->cod_tipo_usuario]) }}" method="POST">
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
                                            <a href="{{ route('admin.feditarRol',['cod_tipo_usuario'=> $rol->cod_tipo_usuario]) }}" title="Editar">
                                                <i class="fa fa-pencil-square fa-2x ml-2 mr-2" aria-hidden="true"></i>
                                            </a>
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
