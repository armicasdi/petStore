<div class="card card-nav-tabs">
    <div class="card-header card-header-info">
        Información del propietario
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="nombrePropietario">Nombres</label>
            <input type="text" class="form-control @error('nombresPropietario') is-invalid @enderror" id="nombrePropietario" name="nombresPropietario"  value="{{ isset($propietario->nombres) ? $propietario->nombres : old('nombresPropietario') }}">
            @error('nombresPropietario')
            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="apellidoPropietario">Apellidos</label>
            <input type="text" class="form-control @error('apellidosPropietario') is-invalid @enderror" id="apellidoPropietario" name="apellidosPropietario" value="{{  isset($propietario->apellidos) ? $propietario->apellidos : old('apellidosPropietario') }}">
            @error('apellidosPropietario')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion" name="direccion" value="{{ isset($propietario->direccion) ? $propietario->direccion :  old('direccion') }}" >
            @error('direccion')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="tel" class="form-control @error('telefono') is-invalid @enderror telefono" id="telefono" name="telefono" value="{{ isset($propietario->telefono) ? $propietario->telefono : old('telefono') }}">
            @error('telefono')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="correo">Correo (opcional)</label>
            <input type="email" class="form-control @error('correo') is-invalid @enderror" id="correo" name="correo" value="{{ isset($propietario->correo) ? $propietario->correo : old('correo') }}">
            @error('direccion')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>
    </div>
</div>
