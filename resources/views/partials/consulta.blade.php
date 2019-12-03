<div class="form-group">
    <label for="historia">Historia clinica</label><br>
    <textarea class="form-control @error('historia_clinica') is-invalid @enderror" id="historia" rows="3" name="historia_clinica">{{ isset($consulta) ? $consulta->historia_clinica : old('historia_clinica') }}</textarea>
    @error('historia_clinica')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="diagnostico">Diagnostico</label><br>
    <textarea class="form-control @error('diagnostico') is-invalid @enderror" id="diagnostico" rows="3" name="diagnostico">{{ isset($consulta) ? $consulta->diagnostico : old('diagnostico') }}</textarea>
    @error('diagnostico')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="tratamiento">Tratamiento</label><br>
    <textarea class="form-control @error('tratamiento') is-invalid @enderror" id="tratamiento" rows="3" name="tratamiento">{{ isset($consulta) ? $consulta->tratamiento : old('tratamiento') }}</textarea>
    @error('tratamiento')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="observaciones">Observaciones</label><br>
    <textarea class="form-control @error('observaciones') is-invalid @enderror" id="observaciones" rows="3" name="observaciones">{{ isset($consulta) ? $consulta->observaciones : old('observaciones') }}</textarea>
    @error('observaciones')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
