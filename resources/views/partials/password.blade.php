<div class="form-group">
    <label for="actual">Contraseña actual</label>
    <input type="password" class="form-control @error('passwordActual') is-invalid @enderror" id="actual" name="passwordActual"  value="{{  old('passwordActual') }}">
    @error('passwordActual')
    <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
    @enderror
</div>


<div class="form-group">
    <label for="password">Nueva contraseña</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"  value="{{ old('password') }}">
    @error('password')
    <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
    @enderror
</div>

<div class="form-group">
    <label for="password_conformation">Repetir contraseña</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password_conformation" name="password_confirmation"  value="{{ old('password') }}">
    @error('password')
    <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
    @enderror
</div>


