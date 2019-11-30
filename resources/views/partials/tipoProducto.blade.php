<div class="card card-nav-tabs">
    <div class="card-header card-header-success">
        Agregar nuevo tipo de producto
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="vacuna">Tipo de producto</label>
            <input type="text" class="form-control @error('tipo_producto') is-invalid @enderror" id="tipo_producto" name="tipo_producto"  value="{{ isset($tipo_producto) ? $tipo_producto->tipo_producto : old('tipo_producto') }}">
            @error('tipo_producto')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
