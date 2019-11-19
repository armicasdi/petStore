@extends('layouts.material')

@section('cssExtra')
    <link rel="stylesheet" href=" {{ asset('css/custom.css') }}">
@endsection

@section('menuLateral')
    @include('inventario.menuLateral')
@endsection

@section('contenido')

            <div class="containter">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="text-uppercase">descripción de producto</div>
                        <form method="POST" action="{{route('inventario.crear')}}">

                            <div class="form-group mt-5">
                                <div class="form-group">
                                    <label for="Proveedor">Proveedor</label>
                                    <select class="form-control" id="Proveedor">
                                        <option selected="selected">Seleccione Proveedor</option>
                                    @foreach($proveedor as $proveedores)
                                    <option value="{{ $proveedores->cod_proveedor }}">{{ $proveedores->nombre_comercial }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <input type="number" name="cantidad[]" id="cantidad[]"  class="form-control" placeholder="Cantidad">
                                <input type="text" name="producto[]" id="producto[]" class="form-control" placeholder="Producto">
                                <input type="text"  class="form-control" name="precio[]" id="precio[]" placeholder="Precio">
                                <input type="date" name="fechav[]" id="fechav[]" class="form-control" placeholder="Fecha vencimiento">
                            </div>
                            <button type="submit" class="btn btn-primary" >Agregar</button>
                        </form>
                    </div>
                </div>
            </div>


            <script src="https://unpkg.com/imask"></script>
            <script>
            var currencyMask = IMask(
            document.getElementById('precio'),
            {
                mask: '$num',
                blocks: {
                num: {
                    // Script para validar
                    mask: Number,
                    thousandsSeparator: ', '
                }
                }
            });

            </script>
@endsection
