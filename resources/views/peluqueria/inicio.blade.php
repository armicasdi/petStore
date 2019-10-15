@extends('layouts.material')

@section('cssExtra')
    <link rel="stylesheet" href=" {{ asset('css/custom.css') }}">
@endsection

@section('menuLateral')
    @include('peluqueria.menuLateral')
@endsection

@section('contenido')
    <div class="row">

        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">pets</i>
                    </div>
                    <h3 class="card-title">{{ $mAtender }}
                        <small>mascotas</small>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Por atender
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">check_box</i>
                    </div>
                    <h3 class="card-title">{{ $mAtendidas }}
                        <small>mascotas</small>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">date_range</i> Atendidadas en este dia
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">done_outline</i>
                    </div>
                    <h3 class="card-title">{{ $mAtendidasMes }}
                        <small>mascotas</small>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">local_offer</i> Este mes
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
