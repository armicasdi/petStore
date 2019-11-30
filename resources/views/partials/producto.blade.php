  <div class="card card-nav-tabs">
    <div class="card-header card-header-success">
        Agregar prodcuto
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="vacuna">Nombre</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre"  value="{{ isset($producto) ? $producto->nombre : old('nombre') }}">
            @error('nombre')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="vacuna">Precio de venta</label>
            <input type="text" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio"  value="{{ isset($producto) ? $producto->precio : old('precio') }}">
            @error('precio')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="especie">Tipo de producto</label>
            <select class="form-control" id="especie" name="cod_tipo_producto">

                @foreach($tiposProductos as $tipoProducto)
                    @if(isset($producto) && $tipoProducto->cod_tipo_producto == $producto->cod_tipo_producto)
                        <option value="{{ $tipoProducto->cod_tipo_producto }}" selected> {{ $tipoProducto->tipo_producto }}</option>
                        @continue
                    @endif
                    <option value="{{ $tipoProducto->cod_tipo_producto }}"> {{ $tipoProducto->tipo_producto }}</option>
                @endforeach
            </select>
        </div>

    </div>
</div>
