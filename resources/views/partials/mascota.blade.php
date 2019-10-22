<div class="card card-nav-tabs">
    <div class="card-header card-header-info">
        Información de la mascota
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="exampleFormControlInput1">Nombre</label>
            <input type="text" class="form-control @error('nombreMascota') is-invalid @enderror" id="exampleFormControlInput1" name="nombreMascota" value="{{ old('nombreMascota') }}">
            @error('nombreMascota')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput2">Fecha nacimiento</label>
            <input type="date" class="form-control @error('fechaNacimiento') is-invalid @enderror" id="exampleFormControlInput2" name="fechaNacimiento" value="{{ old('fechaNacimiento') }}">
            @error('fechaNacimiento')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput3">Color</label>
            <input type="text" class="form-control @error('color') is-invalid @enderror" id="exampleFormControlInput3" name="color" value="{{ old('color') }}">
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
                    <option value="{{ $sexo->cod_sexo }}"> {{ $sexo->sexo }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Especie</label>
            <select class="form-control @error('especie') aria-invalid @enderror" id="especie" name="especie" >
                <option value="0" selected>Seleccione una opción</option>
                @foreach($especies as $especie)
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
            <label for="exampleFormControlSelect3">Reza</label>
            <select class="form-control @error('raza') is-invalid @enderror" id="raza" name="raza">
            </select>
            @error('raza')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </div>

        <div class="form-group" id="mestizo" style="display: none;">
            <label for="tipo">Especificar</label>
            <input type="text" class="form-control" id="tipo" name="tipo">
        </div>
    </div>
</div>
