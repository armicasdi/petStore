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
            @foreach($servicios as $servicio)
                <option value="{{ $servicio->cod_tipo_servicio }}">{{$servicio->servicio}}</option>
            @endforeach
        </select>
        <br>
        <button class="btn btn-info" id="agregar">Agregar</button>

        <form action="{{ route('secretaria.gpeluqueria') }}" method="POST">
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
                @foreach($peluqueros as $peluquero)
                    <option value="{{ $peluquero->cod_usuario }}">{{$peluquero->nombres}} {{ $peluquero->apellidos }}</option>
                @endforeach
            </select>
            <br>
            <button class="btn btn-info mr-5">Guardar</button>
            <a  class="btn btn-info" href="{{ route('secretaria.consulta') }}"> Cancelar</a>
        </form>
@endsection

@section('jsExtra')
    <script>
    $(document).ready(function (){

        $('#agregar').click(function (e) {
           e.preventDefault();
           let servicio = $('#servicio').val();
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

    });
    </script>

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
    @elseif(session()->has('info'))
        <script>
            Command: toastr["info"]("{{ session()->get('info') }}", "¡Información!")
            @include('partials.message')
        </script>
    @endif

@endsection
