@extends('layouts.material')

@section('menuLateral')
    @include('peluqueria.menuLateral')
@endsection

@section('contenido')
        <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-text card-header-warning">
                    <div class="card-text">
                        <h4 class="card-title">Servicios</h4>
                    </div>
                </div>
                <div class="card-body" id="servicios">
                    @foreach($servicios as $servicio)
                            <div class="row">
                                <div class="col-md-10">
                                    <input type="text" hidden name="cod_detalle_peluqueria{{ $servicio->cod_detalle }}" value="{{ $servicio->cod_detalle}}">
                                    <span>{{ $servicio->tipo_servicio->servicio }}</span>
                                </div>
                                <div class="text-left">
                                    <i class="fa  fa-check-square fa-2x text-info"></i>
                                </div>
                            </div>
                    @endforeach

                </div>
            </div>
        </div>
        <br>

        <form action="{{ route('peluqueria.gservicio',['cod_peluqueria'=> $cod_peluqueria]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-text card-header-warning">
                        <div class="card-text">
                            <h4 class="card-title">Servicios relizados</h4>
                        </div>
                    </div>
                    <div class="card-body" id="data">

                    </div>
                </div>
            </div>

            <button class="btn btn-warning">Guardar servicios</button>
        </form>

@endsection

@section('jsExtra')

    <script>
        $(document).ready(function (){
            //    Remover elemto de la lista
            $('#servicios').click(function (e) {
                let servicio = $(e.target).parents().prev();
                let elemento = $(e.target).parents().prev().parent('.row');
                let name = $(servicio).children('input').attr('name');
                let value = $(servicio).children('input').val();
                let txt = $(servicio).children('span').text();

                if(value){
                    let html = `
                     <div class="row">
                                <div class="col-md-10">
                                    <input type="text" hidden name="${name}" value="${value}">
                                    <span>${txt}</span>
                                </div>
                                <div class="text-left">
                                    <i class="fa fa-trash fa-2x text-danger"></i>
                                </div>
                            </div>
                    `;

                    $("#data").append(html).fadeIn(2000);
                    $(elemento).remove().fadeOut(2000);
                }
            });

        //    Agregar elemento a la lista
            $('#data').click(function (e) {
                let servicio = $(e.target).parents().prev();
                let elemento = $(e.target).parents().prev().parent('.row');
                let name = $(servicio).children('input').attr('name');
                let value = $(servicio).children('input').val();
                let txt = $(servicio).children('span').text();

                if(value){
                    let html = `
                     <div class="row">
                                <div class="col-md-10">
                                    <input type="text" hidden name="${name}" value="${value}">
                                    <span>${txt}</span>
                                </div>
                                <div class="text-left">
                                    <i class="fa fa-check-square fa-2x text-info"></i>
                                </div>
                            </div>
                    `;

                    $("#servicios").append(html).fadeIn(2000);
                    $(elemento).remove().fadeOut(2000);
                }
            });

        });
    </script>

@endsection
