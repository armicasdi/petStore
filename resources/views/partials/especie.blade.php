<div class="card card-nav-tabs">
    <div class="card-header card-header-primary">
        Agregar una neva especie de mascota
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="vacuna">Especie</label>
            <input type="text" class="form-control @error('especie') is-invalid @enderror" id="especie" name="especie"  value="{{ isset($especie) ? $especie->especie : old('especie') }}">
            @error('especie')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
