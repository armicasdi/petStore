<script src="{{ asset('js/imask.js') }}"></script>
<div class="card card-nav-tabs">
    <div class="card-header card-header-primary">
        Información del Empleado
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="exampleFormControlInput1">Nombres</label>
            <input type="text" class="form-control @error('nombres') is-invalid @enderror" id="nombres" name="nombres"  value="{{ isset($empleado) ? $empleado->nombres : old('nombres') }}">
            @error('nombres')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Apellidos</label>
            <input type="text" class="form-control @error('apellidos') is-invalid @enderror" id="apellidos" name="apellidos" value="{{  isset($empleado->apellidos) ? $empleado->apellidos : old('apellidos') }}">
            @error('apellidos')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">DUIs</label>
            <input type="number" class="form-control @error('dui') is-invalid @enderror" id="dui" maxlength="9"  name="dui" value="{{  isset($empleado->dui) ? $empleado->dui : old('dui') }}">
            @error('dui')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Fecha de Nacimiento</label>
            <input type="date" class="form-control @error('fech_nac') is-invalid @enderror" id="exampleFormControlInput1" name="fech_nac" value="{{  isset($empleado->fech_nac) ? $empleado->fech_nac : old('fech_nac') }}">
            @error('fech_nac')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Género</label>
            <select class="form-control" id="exampleFormControlSelect1" name="cod_genero">
                @foreach($generos as $genero)
                    @if(isset($empleado) && $genero->cod_genero == $empleado->cod_genero)
                        <option value="{{ $genero->cod_genero }}" selected> {{ $genero->genero }}</option>
                        @continue
                    @endif
                    <option value="{{ $genero->cod_genero }}"> {{ $genero->genero }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono 1</label>
            <input type="tel" class="form-control @error('telefono1') is-invalid @enderror" id="telefono1" name="telefono1" value="{{ isset($empleado->telefono1) ? $empleado->telefono1 : old('telefono1') }}">
            @error('telefono1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono 2 (Opcional)</label>
            <input type="tel" class="form-control @error('telefono2') is-invalid @enderror" id="telefono2" name="telefono2" value="{{ isset($empleado->telefono2) ? $empleado->telefono2 : old('telefono2') }}">
            @error('telefono2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Correo</label>
            <input type="email" class="form-control @error('correo') is-invalid @enderror" id="exampleFormControlInput1" name="correo" value="{{ isset($empleado->correo) ? $empleado->correo : old('correo') }}">
            @error('direccion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Dirección</label>
            <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="exampleFormControlInput1" name="direccion" value="{{ isset($empleado->direccion) ? $empleado->direccion :  old('direccion') }}" >
            @error('direccion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
<script>
var rangeMask = IMask(document.getElementById('dui'), {
  mask: IMask.MaskedRange,
  from: 9,
  to: 999999999,
  maxLength: 9,

});
var patternMask = IMask(document.getElementById('nombres'), {
  mask: '[aaaaaaaaaaaaaaaa] [aaaaaaaaaaaaaaaaaaaaa] [aaaaaaaaaa]'
});
var patternMask = IMask(document.getElementById('apellidos'), {
  mask: '[aaaaaaaaaaaaaaaa] [aaaaaaaaaaaaaaaaaaaaa] [aaaaaaaaaa]'
});
var rangeMask = IMask(document.getElementById('telefono1'), {
  mask: IMask.MaskedRange,
  from: 9,
  to: 99999999,
  maxLength: 8,

});
var rangeMask = IMask(document.getElementById('telefono2'), {
  mask: IMask.MaskedRange,
  from: 9,
  to: 99999999,
  maxLength: 8,

});
  </script>