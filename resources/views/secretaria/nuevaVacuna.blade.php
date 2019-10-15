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

    <form  action="{{ route('secretaria.gvacuna') }}" method="POST">
        @csrf
        <label for="metodo">Vacunas</label>
        <select class="form-control" name="cod_vacuna" id="vacuna">
            @foreach($vacunas as $vacunas)
                <option value="{{ $vacunas->cod_vacuna }}">{{$vacunas->vacuna}}</option>
            @endforeach
        </select>
        <br>
        <label for="metodo">Veterinario que atendera la mascota</label>
        <select class="form-control" name="cod_usuario">
            @foreach($veterinarios as $veterinario)
                <option value="{{ $veterinario->cod_usuario }}">{{$veterinario->nombres}} {{ $veterinario->apellidos }}</option>
            @endforeach
        </select>
        <input type="hidden" name="cod_expediente" value="{{ $mascota->cod_expediente }}">
        <button class="btn btn-info" id="agregar">Guardar</button>
    </form>

{{--    Formulario para Agregar muchas vacuanas el mismo tiempo --}}
{{--    <form action="{{ route('secretaria.gvacuna') }}" method="POST">--}}
{{--        @csrf--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-6">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <h4 class="card-title">Vacunas selecionadas</h4>--}}
{{--                    </div>--}}
{{--                    <div class="card-body" id="data">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <input type="hidden" name="cod_expediente" value="{{ $mascota->cod_expediente }}">--}}
{{--        <br>--}}
{{--        <label for="metodo">Veterinario que atendera la mascota</label>--}}
{{--        <select class="form-control" name="cod_usuario">--}}
{{--            @foreach($veterinarios as $veterinario)--}}
{{--                <option value="{{ $veterinario->cod_usuario }}">{{$veterinario->nombres}} {{ $veterinario->apellidos }}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--        <button class="btn btn-info">Guardar</button>--}}
{{--    </form>--}}
@endsection

{{--@section('jsExtra')--}}
{{--    <script>--}}
{{--    $(document).ready(function (){--}}

{{--        $('#agregar').click(function (e) {--}}
{{--           e.preventDefault();--}}
{{--           let vacuna = $('#vacuna').val();--}}
{{--           if(vacuna){--}}
{{--               let objVacuna = $("#vacuna [value="+vacuna+"]");--}}
{{--               let html = `--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-10">--}}
{{--                                <input type="text" hidden name="vacuna${vacuna}" value="${vacuna}">--}}
{{--                                <span data-code="${vacuna}" >${ $(objVacuna).text()}</span>--}}
{{--                            </div>--}}
{{--                            <div class="text-center">--}}
{{--                                <i class="fa fa-trash fa-2x text-danger"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                   `;--}}
{{--               $("#data").append(html);--}}
{{--               objVacuna.remove();--}}
{{--           }--}}
{{--        });--}}

{{--        $("#data").click(function (e) {--}}
{{--            let vacuna = $(e.target).parent().prev().children("span");--}}
{{--            let id = $(vacuna).attr('data-code');--}}
{{--            if(id){--}}
{{--                let txt = $(vacuna).text();--}}
{{--                let html = `--}}
{{--                    <option value="${id}">${txt}</option>--}}
{{--                `;--}}
{{--                $("#vacuna").append(html);--}}
{{--                $(vacuna).parent().parent().remove().fadeOut(1000);--}}
{{--            }--}}
{{--        });--}}

{{--    });--}}
{{--    </script>--}}
{{--@endsection--}}
