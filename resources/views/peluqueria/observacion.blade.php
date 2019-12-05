
@extends('layouts.material')

@section('menuLateral')
    @include('peluqueria.menuLateral')
@endsection

@section('contenido')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-warning">
                    <h4 class="card-title ">Observación</h4>
                    <p>Este campo es opcional pero esta información puede ser de mucha ayuda para tus futuras atenciones a la mascota</p>
                </div>

                <div class="card-body">
                    <form action="{{ route('peluqueria.gobservacion', ['cod_peluqueria' => $cod_peluqueria]) }}" method="POST" id="formObservacion">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="diagnostico">Observación</label><br>
                            <textarea class="form-control"  id="diagnostico" rows="3" name="observaciones">{{ old('observaciones') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-warning mr-5" id="guardar">Guardar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('jsExtra')
    <script src="{{ asset('js/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/validation/jquery.validate.additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/validation/messages_es.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#guardar").click(function (event) {
                $("#formObservacion").validate({
                    rules: {
                        observaciones: {
                            maxlength: 300,
                        },
                    },
                });
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
    @endif
@endsection

