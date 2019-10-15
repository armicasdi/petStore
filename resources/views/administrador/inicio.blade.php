
@extends('layouts.material')

@section('menuLateral')
    @include('administrador.menuLateral')
@endsection

@section('contenido')

    <div class="row">

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">pets</i>
                    </div>
                    <h3 class="card-title">{{ $mAtendidas }}
                        <small>mascotas</small>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Por atendia este dia
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">check_box</i>
                    </div>
                    <h3 class="card-title">{{ $mAtendidasSemana }}
                        <small>mascotas</small>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                         Atendidadas esta semana
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
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
                        Atendidas este mes
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">unarchive</i>
                    </div>
                    <h3 class="card-title">{{ $mTotal }}
                        <small>mascotas</small>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Registradas
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
