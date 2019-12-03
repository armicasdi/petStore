<div class="card card-nav-tabs">
    <div class="card-header card-header-info">
        Información de la mascota
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="nombreMascota">Nombre</label>
            <input type="text" class="form-control @error('nombreMascota') is-invalid @enderror" id="nombreMascota" name="nombreMascota" value="{{ isset($mascota) ? $mascota->nombre : old('nombreMascota') }}">
            @error('nombreMascota')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="fechaNacimiento">Fecha nacimiento</label>
            <input type="date" class="form-control @error('fechaNacimiento') is-invalid @enderror" id="fechaNacimiento" name="fechaNacimiento" value="{{ isset($mascota) ? $mascota->fecha_nac : old('fechaNacimiento') }}">
            @error('fechaNacimiento')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="color">Color</label>
            <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" value="{{ isset($mascota) ? $mascota->Color :  old('color') }}">
            @error('color')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Sexo</label>
            <select class="form-control" id="exampleFormControlSelect1" name="sexo">
                @foreach($sexos as $sexo)
                    @if(isset($mascota) && $sexo->cod_sexo == $mascota->cod_sexo)
                        <option value="{{ $sexo->cod_sexo }}" selected> {{ $sexo->sexo }}</option>
                        @continue
                    @endif
                        <option value="{{ $sexo->cod_sexo }}"> {{ $sexo->sexo }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Especie</label>
            <select class="form-control @error('especie') aria-invalid @enderror" id="especie" name="especie" >
                <option value="0" selected>Seleccione una opción</option>
                @foreach($especies as $especie)
                    @if(isset($mascota) && $especie->cod_especie == $mascota->raza->cod_especie)
                        <option value="{{ $especie->cod_especie }}" selected>{{ $especie->especie }}</option>
                        @continue
                    @endif
                        <option value="{{ $especie->cod_especie }}">{{ $especie->especie }}</option>
                @endforeach
            </select>
            @error('especie')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect3">Raza</label>
            <select class="form-control @error('raza') is-invalid @enderror" id="raza" name="raza">
                @if(isset($mascota))
                    @foreach($razas as $raza)
                        @if($raza->cod_raza == $mascota->raza->cod_raza)
                            <option value="{{ $raza->cod_raza }}" selected>{{ $raza->raza}}</option>
                            @continue
                        @endif
                        <option value="{{ $raza->cod_raza }}">{{ $raza->raza}}</option>
                    @endforeach
                @endif
            </select>
            @error('raza')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </div>

        <div class="form-group" id="mestizo" style="display:{{ isset($mascota) && ( $mascota->raza->cod_raza == 29 || $mascota->raza->cod_raza == 30) ? 'show' : 'none' }};">
            <label for="tipo">Especificar</label>
            <input type="text" class="form-control" id="tipo" name="tipo" value="{{ isset($mascota) ? $mascota->tipo : '' }}">
        </div>
    </div>
</div>
