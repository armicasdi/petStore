<div class="card card-nav-tabs">
    <div class="card-header card-header-primary">
        Agregar servicio
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="vacuna">Tipo de servicio</label>
            <input type="text" class="form-control @error('servicio') is-invalid @enderror" id="servicio" name="servicio"  value="{{ isset($servicio) ? $servicio->servicio : old('servicio') }}">
            @error('servicio')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
