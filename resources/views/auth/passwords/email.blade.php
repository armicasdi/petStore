@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Solicitud de reseteo de contraseña') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('passwordReset') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="usuario" class="col-md-4 col-form-label text-md-right">{{ __('Usuario') }}</label>

                            <div class="col-md-6">
                                <input id="usuario" type="usuario" class="form-control @error('usuario') is-invalid @enderror" name="usuario" value="{{ old('usuario') }}" required autocomplete="usuario" autofocus>

                                @error('usuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="text-secondary"> La solicitus es enviada a la cola de reseteo de contraseña, donde la persona encargada del proceso valida la acción</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
