<div class="card card-nav-tabs">
    <div class="card-header card-header-primary">
        Agregar bodega
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="vacuna">Ubicación</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre"  value="{{ isset($bodega) ? $bodega->nombre : old('nombre') }}">
            @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
