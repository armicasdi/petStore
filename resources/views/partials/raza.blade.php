<div class="card card-nav-tabs">
    <div class="card-header card-header-primary">
        Agregar vacuna
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="vacuna">Nombre</label>
            <input type="text" class="form-control @error('vacuna') is-invalid @enderror" id="vacuna" name="vacuna"  value="{{ isset($vacuna) ? $vacuna->vacuna : old('vacuna') }}">
            @error('vacuna')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
