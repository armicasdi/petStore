
@extends('layouts.material')

@section('menuLateral')
    @include('administrador.menuLateral')
@endsection

@section('contenido')

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Solicitudes de cambio de contraseña</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>usuario</th>
                                <th>Tipo Usuario</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                                </thead>
                            <tbody>
                                @foreach($usuarios as $usuario)
                                    <tr>
                                        <td>{{ $usuario->usuario }}</td>
                                        <td>{{ $usuario->tipo_usuario->tipo }}</td>
                                        <td>{{ $usuario->empleados->nombres }} {{ $usuario->empleados->apellidos }}</td>

                                        <td>
                                            <a href="#"  title="Aprobar" data-toggle="modal" data-target="#aprobar{{ $loop->iteration }}">
                                                <i class="fa fa-check-square fa-lg ml-2 mr-2" aria-hidden="true"></i>
                                            </a>

                                            <a href="#" title="Eliminar" data-toggle="modal" data-target="#cancelar{{ $loop->iteration }}">
                                                <i class="fa fa-trash fa-lg ml-2" aria-hidden="true"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="aprobar{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="aprobarm{{ $loop->iteration }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">
                                                            <h5 class="modal-title" id="aprobarm{{ $loop->iteration }}">Aprobar reseteo de contraseña</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                           Si realiza esta acción, la contraseña del usuario será reseteada a: <strong>petfamily</strong>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('password.cambio',['cod_usuario'=>$usuario->cod_usuario]) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="submit" class="btn btn-primary">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {{-- End modal--}}

                                            <!-- Modal -->
                                            <div class="modal fade" id="cancelar{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="cancelar{{ $loop->iteration }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">
                                                            <h5 class="modal-title" id="cancelar{{ $loop->iteration }}">Cancelar solicitud</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Esta seguro de cancelar la solicitud de reseteo de contraseña
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('password.cancelar',['cod_usuario'=>$usuario->cod_usuario]) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
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
