@extends('layouts.material')

@section('menuLateral')
    @include('secretaria.menuLateral')
@endsection

@section('contenido')
        <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-text card-header-info">
                    <div class="card-text">
                        <h4 class="card-title"> {{ $mascota->nombre }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div>Fecha de nacimiento: {{ date("d/m/Y", strtotime($mascota->fecha_nac)) }}</div>
                    <div>Color: {{ $mascota->Color }}</div>
                </div>
            </div>
        </div>

    <form  action="{{ route('secretaria.gvacuna') }}" method="POST" id="nuevaVacuna">
        @csrf
        <label for="metodo">Vacunas</label>
        <select class="form-control" name="cod_vacuna" id="vacuna">
            @if(!$vacunas->isEmpty())
                @foreach($vacunas as $vacunas)
                    <option value="{{ $vacunas->cod_vacuna }}">{{$vacunas->vacuna}}</option>
                @endforeach
            @else
                <option value="">No hay vacunas registradas o no se han habilitado</option>
            @endif
        </select>
        <br>
        <label for="metodo">Veterinario que atendera la mascota</label>
        <select class="form-control" name="cod_usuario">
            @if(!$veterinarios->isEmpty())
                @foreach($veterinarios as $veterinario)
                    <option value="{{ $veterinario->cod_usuario }}">{{$veterinario->nombres}} {{ $veterinario->apellidos }}</option>
                @endforeach
            @else
                <option value="">No hay vaterinarios registrados o no se han habilitado</option>
            @endif
        </select>
        <br>
        <input type="hidden" name="cod_expediente" value="{{ $mascota->cod_expediente }}">
        <button class="btn btn-info mr-5" id="agregar">Guardar</button>
        <a  class="btn btn-default" href="{{ route('secretaria.consulta') }}"> Cancelar</a>
    </form>

@endsection

@section('jsExtra')

    <script src="{{ asset('js/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/validation/jquery.validate.additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/validation/messages_es.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#agregar").click(function (event) {
                jQuery.validator.addMethod("formato", function (value, element) {
                    return this.optional(element) || /^\d+$/.test(value);
                }, "Selecciona una opción de la lista");

                $("#nuevaVacuna").validate({
                    rules: {
                        cod_vacuna: {
                            required: true,
                            formato: true
                        },
                        cod_usuario:{
                            required: true,
                            formato: true,
                        }
                    },
                });
            });

        });
    </script>

    @if(session()->has('info'))
        <script>
            Command: toastr["info"]("{{ session()->get('info') }}", "¡Información!")
            @include('partials.message')
        </script>
    @endif

@endsection

