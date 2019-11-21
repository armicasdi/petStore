
@extends('layouts.material')

@section('menuLateral')
    @include('inventario.menuLateral')
@endsection

@section('contenido')

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header card-header-success">
                    <h4 class="card-title ">Entrada de producto</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="POST" id="formDetalle">
                        @csrf
                        <div class="form-group">
                            <label for="descripcion">Descripción de compra</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion">
                        </div>

                        <div class="form-group">
                            <label for="proveedor">Proveedor</label>
                            <select class="form-control" id="proveedor" name="cod_proveedor">
                                @foreach($proveedores as $proveedor)
                                    <option value="{{ $proveedor->cod_proveedor }}"> {{ $proveedor->nombre_comercial }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- DETALLE --}}
                        <div class="card">
                            <div class="card-header card-header-success">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="card-title ">Detalle de compra</h4>
                                    </div>
                                    <div class="col-6 card-title text-right pr-5">
                                        <a href="#" title="Bloquear" data-toggle="modal" data-target="#agregar">
                                            <i class="fa fa-plus-square fa-lg mr-2"></i>
                                            Agregar producto
                                        </a>
                                    </div>
                                </div>
                            </div>
                            {{-- Modal --}}
                            <div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="agregarm" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="agregarm">Detalle de producto</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="cantidad">Cantidad</label>
                                                    <input type="number" class="form-control" id="cantidad" name="cantidad">
                                                </div>
                                                <div class="form-group">
                                                    <label for="producto">Producto</label>
                                                    <select class="form-control" id="producto" name="cod_producto">
                                                        @foreach($productos as $producto)
                                                            <option value="{{ $producto->cod_producto }}"> {{ $producto->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="precio">Precio unitario</label>
                                                    <input type="text" class="form-control" id="precio" name="valor">
                                                </div>
                                                <div class="form-group">
                                                    <label for="fecha_vencimiento">Fecha de vencimiento</label>
                                                    <input type="date" class="form-control" id="fecha_vencimiento" name="feha_vencimiento">
                                                </div>
                                                <div class="text-right">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                                                    <input id="agregarProducto" type="submit" value="Agregar" class="btn btn-success"> {{-- data-dismiss="modal" --}}
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End modal--}}
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Cantidad</th>
                                            <th>Producto</th>
                                            <th>Precio unitario</th>
                                            <th>Fecha de vencimiento</th>
                                            <th class="text-right">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detalles">
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        {{-- ENN DETALLE --}}

                        <button type="submit" class="btn btn-success" id="guardar">Guardar</button>
                        <a href="" class="btn btn-success" id="cancelar">Cancelar</a>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('jsExtra')
    <script src="{{ asset('js/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/validation/jquery.validate.additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/validation/messages_es.js') }}"></script>
    <script>
        $(document).ready(function () {
            class Detalle {
                constructor(cantidad,cod_producto,valor,fecha_vencimiento){
                    this.cantidad = cantidad,
                    this.cod_producto = cod_producto,
                    this.valor = valor,
                    this.fecha_vencimiento = fecha_vencimiento
                }
            }

            var data = [];
            var detalles = $("#detalles");

            $("#agregarProducto").click(function (event) {
                jQuery.validator.addMethod("formato", function (value, element) {
                    return this.optional(element) || /^(\d+|\d+.\d{1,2})$/.test(value);
                }, "La cantidad ingresada no es valida");

                $( "#formDetalle").validate({
                    rules: {
                        descripcion: {
                            required: true,
                            minlength: 1,
                            maxlength: 150
                        },
                        cod_proveedor : {
                            required: true,
                        },
                        cantidad: {
                            required: true,
                            number: true,
                            min: 1,
                            max: 100,
                        },
                        cod_producto: {
                            required: true,
                        },
                        valor:{
                            required: true,
                            formato: true,
                            range: [0.01,1000]
                        },
                        feha_vencimiento:{
                            required: true,
                            dateISO: true
                        }
                    },
                    submitHandler: function (form) {

                        let cantidad = $("#cantidad").val();
                        let cod_producto = $("#producto").val();
                        let producto = $("#producto option:selected").text();
                        let valor = $("#precio").val();
                        let fecha_vencimiento = $("#fecha_vencimiento").val();

                        var detalle = new Detalle(cantidad,cod_producto,valor,fecha_vencimiento);

                        var indice = (data.push(detalle) -1);

                        var html = `
                                    <tr>
                                        <td>${detalle.cantidad}</td>
                                        <td>${producto}</td>
                                        <td>&dollar; ${detalle.valor}</td>
                                        <td>${detalle.fecha_vencimiento}</td>
                                        <td class="td-actions text-right">
                                            <button type="button" rel="tooltip" class="btn btn-danger eliminar" value="${indice}">
                                               <i class="fa fa-trash fa-2x" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                `;

                        detalles.append(html);
                        $("#cantidad").val('');
                        $("#producto").val(1);
                        $("#precio").val('');
                        $("#fecha_vencimiento").val('');
                    }
                });
            });

            // eliminar
            $("#detalles").click(function (event) {
                var elemento = $(event.target).parents("td");
                if(elemento.length){
                    indice = elemento.find("button")[0].value;
                    delete data[indice];
                    elemento.parent().remove();
                }
            });

            $("#guardar").click(function (event) {
                event.preventDefault();
                    // Eliminar los items vacios del array antes de enviarlo al server
                data = $.grep(data,function (valor) {
                    return(valor);
                });

                let descripcion = $("#descripcion").val();
                let cod_proveedor  = $("#proveedor").val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('entrada') }}",
                    data: { descripcion: descripcion,cod_proveedor: cod_proveedor, data: data} ,
                    success: function (respuesta) {
                        Command: toastr["success"](respuesta.data);
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }

                        $("#detalles").empty();
                        $("#descripcion").val('');
                        $("#proveedor").val(0);
                    },
                    error: function (error) {
                        Command: toastr["error"](error.responseJSON.data);
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                });
            });

            // CANCELAR
            $("#cancelar").click(function (event) {
                event.preventDefault();
                var confirmar = confirm("Esta seguro de cancelar el ingreso producto al formulario,\n Se perdera toda la información iongresada hasta ahora");
                if(confirmar){
                    $("#detalles").empty();
                    $("#descripcion").val('');
                    $("#proveedor").val(0);
                }
            });

        });

    </script>
@endsection
