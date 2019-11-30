  <div class="card card-nav-tabs">
    <div class="card-header card-header-primary">
        Agregar raza
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="vacuna">Raza</label>
            <input type="text" class="form-control @error('raza') is-invalid @enderror" id="raza" name="raza"  value="{{ isset($raza) ? $raza->raza : old('raza') }}">
            @error('raza')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="especie">Especies</label>
            <select class="form-control" id="especie" name="cod_especie">

                @foreach($especies as $especie)
                    @if(isset($raza) && $especie->cod_especie == $raza->cod_especie)
                        <option value="{{ $especie->cod_especie }}" selected> {{ $especie->especie }}</option>
                        @continue
                    @endif
                    <option value="{{ $especie->cod_especie }}"> {{ $especie->especie }}</option>
                @endforeach
            </select>
        </div>

    </div>
</div>
