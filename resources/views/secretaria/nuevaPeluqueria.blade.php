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

        <label for="servicio">Servicios</label>
        <select class="form-control" id="servicio">
            @if(!$servicios->isEmpty())
                @foreach($servicios as $servicio)
                    <option value="{{ $servicio->cod_tipo_servicio }}">{{$servicio->servicio}}</option>
                @endforeach
            @endif
        </select>
        @if($servicios->isEmpty())
            <span class="text-danger">
                <strong>No hay servicios de peluqueria registrados o no han sido habilitados</strong>
            </span>
        @endif
        <br>
        <button class="btn btn-info" id="agregar">Agregar</button>

        <form action="{{ route('secretaria.gpeluqueria') }}" method="POST" id="formPeluqueria">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Servicios seleccionados</h4>
                        </div>
                        <div class="card-body" id="data">
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="cod_expediente" value="{{ $mascota->cod_expediente }}">
            <br>
            <label for="metodo">Peluquero que atendera la mascota</label>
            <select class="form-control" name="cod_usuario">
                @if(!$peluqueros->isEmpty())
                    @foreach($peluqueros as $peluquero)
                        <option value="{{ $peluquero->cod_usuario }}">{{$peluquero->nombres}} {{ $peluquero->apellidos }}</option>
                    @endforeach
                @else
                    <option value="">No hay peluqueros registrados o no han sido habilitados</option>
                @endif
            </select>
            <br>
            <button class="btn btn-info mr-5" id="guardar">Guardar</button>
            <a  class="btn btn-default" href="{{ route('secretaria.consulta') }}"> Cancelar</a>
        </form>
@endsection

@section('jsExtra')
    <script src="{{ asset('js/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/validation/jquery.validate.additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/validation/messages_es.js') }}"></script>
    <script>
    $(document).ready(function (){

        $('#agregar').click(function (e) {
           e.preventDefault();
           let servicio = $('#servicio').val();
           console.log(servicio);
           if(servicio){
               let objSevicio = $("#servicio [value="+servicio+"]");
               let html = `
                        <div class="row">
                            <div class="col-md-10">
                                <input type="text" hidden name="servicio${servicio}" value="${servicio}">
                                <span data-code="${servicio}" >${ $(objSevicio).text()}</span>
                            </div>
                            <div class="text-center">
                                <i class="fa fa-trash fa-2x text-danger"></i>
                            </div>
                        </div>
                   `;
               $("#data").append(html);
               objSevicio.remove();
           }
        });

        $("#data").click(function (e) {
            let servicio = $(e.target).parent().prev().children("span");
            let id = $(servicio).attr('data-code');
            if(id){
                let txt = $(servicio).text();
                let html = `
                    <option value="${id}">${txt}</option>
                `;
                $("#servicio").append(html);
                $(servicio).parent().parent().remove().fadeOut(1000);
            }
        });

        // VALIDACIÓN
        $("#guardar").click(function (event) {

            jQuery.validator.addMethod("snumeros", function (value, element) {
                return this.optional(element) || /^\d+$/.test(value);
            }, "Selecciona una opción de la lista");


            $("#formPeluqueria").validate({
                rules: {
                    cod_usuario: {
                        required: true,
                        snumeros: true,
                    }
                },
            });
        });

    });
    </script>

    @if(session()->has('error'))
        <script>
            Command: toastr["error"]("{{ session()->get('error') }}", "¡Error!")
            @include('partials.message')
        </script>
    @endif
    @if(session()->has('info'))
        <script>
            Command: toastr["info"]("{{ session()->get('info') }}", "¡Información!")
            @include('partials.message')
        </script>
    @endif

@endsection
