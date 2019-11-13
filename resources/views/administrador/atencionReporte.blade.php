@extends('layouts.material')

@section('menuLateral')
    @include('administrador.menuLateral')
@endsection

{{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">--}}
{{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">--}}
@section('contenido')

    <div class="container">
        <h3 align="center">PetFamily</h3><br />

        <div class="row">
            <div class="col-md-7" align="right">
                <h4>Atencion a Mascotas</h4>
                <h4>Generado: {{ date('d-m-Y h:i:s a') }}</h4>
                <h4>Creado por: {{ Auth::user()->empleados->nombres }} {{ Auth::user()->empleados->apellidos }}</h4>
            </div>

        </div>
        <br />

        <form>

            <div class="form-group">
                <label for="servicio">Servicio Realizado</label>
                <select class="form-control" id="servicio" name="servicio">
                    <option value="Consulta">Consulta</option>
                    <option value="Control_Vacunas">Vacuna</option>
                    <option value="Peluqueria">Peluqueria</option>
                </select>
            </div>
            <br>

            <div class="form-group">
                <label for="mes">Mes de Consulta</label>
                <select class="form-control" id="mes" name="mes">
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="semana">Mes de Consulta</label>
                <select class="form-control" id="semana" name="semana">
                    <option value="all">Todas</option>
                    <option value="1">Semana 1</option>
                    <option value="2">Semana 2</option>
                    <option value="3">Semana 3</option>
                    <option value="4">Semana 4</option>

                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="year">Año</label>
                <select class="form-control" id="year" name="year">
                    <option value="2019">2019</option>
                </select>
            </div>
            <br>
            <div class="col-md-5" align="right">
                <a id="verRegistro"  class="btn btn-info">Ver Registro</a>
            </div>
        </form>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script>

        $(document).ready(function (){
        $('#verRegistro').click(function (e){
            e.preventDefault();
            console.log("Hola");
            let servicio = $('#servicio').val();
            let mes = $('#mes').val();
            let semana = $('#semana').val();
            let year = $('#year').val();
            window.location.href = '/administracion/registroAtencion/'+servicio+'/'+mes+'/'+year+'/'+semana;
        })
        })
    </script>
@endsection
