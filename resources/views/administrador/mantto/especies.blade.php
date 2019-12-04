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
                            <h4 class="card-title">Especies registradas</h4>
                        </div>
                        <div class="col-6 card-title text-right pr-5">
                            <a href="{{ route('especie.fagregar') }}"> <i class="fa fa-plus-square fa-lg mr-2"></i>Agregar</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                            <th>Identificador</th>
                            <th>especies</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody>
                            @if(!$especies->isEmpty())
                                @foreach($especies as $especie)
                                    <tr>
                                        <td>{{ $especie->cod_especie }}</td>
                                        <td>{{ $especie->especie }}</td>
                                        @if( $especie->is_active)
                                            <td>
                                                <a href="#" title="Bloquear" data-toggle="modal" data-target="#bloquear{{ $especie->cod_especie }}">
                                                    <i class="fa fa-unlock fa-lg text-success" aria-hidden="true"></i>
                                                </a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="bloquear{{ $especie->cod_especie }}" tabindex="-1" role="dialog" aria-labelledby="bloquearm{{ $especie->cod_especie }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header text-center">
                                                                <h5 class="modal-title" id="bloquearm{{ $especie->cod_especie }}">Bloquear especie</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Si bloquea la especie, no podra ser seleccionada para las proximas transacciones en el sistema y las razas asociadas serán bloqueadas automáticamente
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <form action="{{ route('especie.bloquear',['cod_especie'=>$especie->cod_especie]) }}" method="POST">
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
                                                <a href="#" title="Bloquear" data-toggle="modal" data-target="#desbloquear{{ $especie->cod_especie }}">
                                                    <i class="fa fa-lock fa-lg text-danger" aria-hidden="true"></i>
                                                </a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="desbloquear{{ $especie->cod_especie }}" tabindex="-1" role="dialog" aria-labelledby="desbloquearm{{ $especie->cod_especie }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header text-center">
                                                                <h5 class="modal-title" id="desbloquearm{{ $especie->cod_especie }}">Desbloquear especie</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Si realiza la siguiente acción, el resgistro de la especie podra ser utilizado para las proximas transacciones del sistema y las razas asociadas serán desbloqueadas automáticamente
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <form action="{{ route('especie.bloquear',['cod_especie'=>$especie->cod_especie]) }}" method="POST">
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
                                            <a href="{{ route('especie.factualizar',['cod_especie' => $especie->cod_especie]) }}" title="Editar">
                                                <i class="fa fa-pencil-square fa-lg ml-2 mr-2" aria-hidden="true"></i>
                                            </a>

                                            <a href="#" title="Eliminar" data-toggle="modal" data-target="#eliminar{{ $especie->cod_especie }}">
                                                <i class="fa fa-trash fa-lg ml-2" aria-hidden="true"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="eliminar{{ $especie->cod_especie }}" tabindex="-1" role="dialog" aria-labelledby="eliminarm{{ $especie->cod_especie }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">
                                                            <h5 class="modal-title" id="eliminarm{{ $especie->cod_especie }}">Eliminar especie</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Esta seguro de eliminar el registro de la especie, si lo hace ya no se podra utilizar para las proximas transacciones
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('especie.eliminar',['cod_especie'=>$especie->cod_especie]) }}" method="POST">
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
                        @if($especies->isEmpty())
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
