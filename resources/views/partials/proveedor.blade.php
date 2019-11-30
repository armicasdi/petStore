
<div class="card card-nav-tabs">
    <div class="card-header card-header-success">
        Información del proveedor
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="exampleFormControlInput1">Nombre juridico</label>
            <input type="text" class="form-control @error('nombre_juridico') is-invalid @enderror" id="nombre_juridico" name="nombre_juridico"  value="{{ isset($proveedor) ? $proveedor->nombre_juridico : old('nombre_juridico') }}">
            @error('nombre_juridico')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Nombre comercial</label>
            <input type="text" class="form-control @error('nombre_comercial') is-invalid @enderror" id="nombre_comercial" name="nombre_comercial" value="{{  isset($proveedor->nombre_comercial) ? $proveedor->nombre_comercial : old('nombre_comercial') }}">
            @error('nombre_comercial')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Dirección</label>
            <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion" name="direccion" value="{{  isset($proveedor->direccion) ? $proveedor->direccion : old('direccion') }}">
            @error('direccion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono 1</label>
            <input type="tel" class="form-control @error('telefono1') is-invalid @enderror" id="telefono1" name="telefono1" value="{{ isset($proveedor->telefono1) ? $proveedor->telefono1 : old('telefono1') }}">
            @error('telefono1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono 2 (Opcional)</label>
            <input type="tel" class="form-control @error('telefono2') is-invalid @enderror" id="telefono2" name="telefono2" value="{{ isset($proveedor->telefono2) ? $proveedor->telefono2 : old('telefono2') }}">
            @error('telefono2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Correo</label>
            <input type="email" class="form-control @error('correo') is-invalid @enderror" id="exampleFormControlInput1" name="correo" value="{{ isset($proveedor->correo) ? $proveedor->correo : old('correo') }}">
            @error('correo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Descripción del servicio que ofrece</label>
            <input type="text" class="form-control @error('descripcion') is-invalid @enderror" id="exampleFormControlInput1" name="descripcion" value="{{ isset($proveedor->descripcion) ? $proveedor->descripcion :  old('descripcion') }}" >
            @error('descripcion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
