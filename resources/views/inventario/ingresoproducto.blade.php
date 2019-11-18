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
                        <form>
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
                            </div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Ingreso">Agregar</button>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="Ingreso" tabindex="-1" role="dialog" aria-labelledby="IngresoLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="IngresoLabel">Ingrese datos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                        <input type="number" class="form-control" placeholder="Cantidad">
                        <input type="text" class="form-control" placeholder="Producto">
                        <input type="text" class="form-control" name="currency-field" id="currency-field" placeholder="Precio">
                        <input type="date" class="form-control" placeholder="Fecha vencimiento">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
                </div>
            </div>
            </div>
            </form>
            <script src="https://unpkg.com/imask"></script>
            <script>
            var currencyMask = IMask(
            document.getElementById('currency-field'),
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
