
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
                            <h4 class="card-title ">Usuarios registrados</h4>
                        </div>
                        <div class="col-6 card-title text-right pr-5">
                            <a href="{{ route('admin.agregar') }}"> <i class="fa fa-plus-square fa-lg mr-2"></i>Nuevo usuario</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>usuario</th>
                                <th>Nombre</th>
                                <th>Tipo Usuario</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                                </thead>
                            <tbody>
                                @foreach($empleados as $empleado)
                                    <tr>
                                        <td>{{ $empleado->usuario->usuario }}</td>
                                        <td>{{ $empleado->nombres }} {{ $empleado->apellidos }}</td>
                                        <td>{{ $empleado->usuario->tipo_usuario->tipo }}</td>
                                        @if( $empleado->usuario->is_active)
                                            <td>
                                                <a href="#" title="Bloquear" data-toggle="modal" data-target="#bloquear{{ $empleado->cod_usuario }}">
                                                   <i class="fa fa-unlock fa-lg text-success" aria-hidden="true"></i>
                                                </a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="bloquear{{ $empleado->cod_usuario }}" tabindex="-1" role="dialog" aria-labelledby="bloquearm{{ $empleado->cod_usuario }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header text-center">
                                                                <h5 class="modal-title" id="bloquearm{{ $empleado->cod_usuario }}">Bloquear usuario</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Si bloquea el usuario no podra acceder a sus funciones
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <form action="{{ route('admin.bloquear',['cod_usuario'=>$empleado->cod_usuario]) }}" method="POST">
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
                                                    <a href="#" title="Bloquear" data-toggle="modal" data-target="#desbloquear{{ $empleado->cod_usuario }}">
                                                        <i class="fa fa-lock fa-lg text-danger" aria-hidden="true"></i>
                                                    </a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="desbloquear{{ $empleado->cod_usuario }}" tabindex="-1" role="dialog" aria-labelledby="desbloquearm{{ $empleado->cod_usuario }}" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header text-center">
                                                                    <h5 class="modal-title" id="desbloquearm{{ $empleado->cod_usuario }}">Desbloquear usuario</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Si realiza la siguiente acción, el usuario tendra acceso a sus funciones
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                    <form action="{{ route('admin.bloquear',['cod_usuario'=>$empleado->cod_usuario]) }}" method="POST">
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
                                            <a href="#" title="Mostrar">
                                                <i class="fa fa-eye fa-lg mr-2" aria-hidden="true"></i>
                                            </a>
                                            <a href="#" title="Editar">
                                                <i class="fa fa-pencil-square fa-lg ml-2 mr-2" aria-hidden="true"></i>
                                            </a>
                                            <a href="#" title="Eliminar">
                                                <i class="fa fa-trash fa-lg ml-2" aria-hidden="true"></i>
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
