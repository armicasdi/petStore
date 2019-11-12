
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script>
    var year = ['2019','2020','2021', '2022'];
    var data_viewer = {{ $viewer }} ;


    var barChartData = {
        labels: year,
        datasets: [{
            label: 'Consultas generadas por año',
            backgroundColor: "rgba(151,187,205,0.5)",
            data: data_viewer
        }]
    };


    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: 'rgb(0, 255, 0)',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Gráfica consulta'
                }
            }
        });


    };
</script>


<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <canvas id="canvas" height="280" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
