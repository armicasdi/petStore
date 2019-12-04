
@extends('layouts.material')

@section('menuLateral')
    @include('secretaria.menuLateral')
@endsection

@section('contenido')

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header card-header-info">
                    <h4 class="card-title ">Nueva venta</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="POST" id="formDetalle">
                        @csrf
                        <p>Ingrese el detalle de la venta</p>

                        {{-- DETALLE --}}
                        <div class="card">
                            <div class="card-header card-header-info">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="card-title ">Detalle de venta</h4>
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
                                                        <option value="0">Seleccione un producto</option>
                                                        @foreach($productos as $producto)
                                                            <option value="{{ $producto->cod_producto }}"> {{ $producto->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="precio">Precio unitario</label>
                                                    <input type="text" class="form-control" id="precio" name="valor"  readonly value="0.00">
                                                </div>
                                                <div class="text-right">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                                                    <input id="agregarProducto" type="submit" value="Agregar" class="btn btn-info"> {{-- data-dismiss="modal" --}}
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
                                            <th>Subtotal</th>
                                            <th class="text-right">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detalles">
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <div class="text-gray h4">
                                    <span>Total: $</span>
                                    <span id="total">0.00</span>
                                </div>
                            </div>


                        </div>
                        {{-- ENN DETALLE --}}

                        <button type="submit" class="btn btn-info" id="guardar">Guardar</button>
                        <a href="" class="btn btn-default" id="cancelar">Cancelar</a>
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

            $("#producto").change(function () {
                    let cod_producto = $(this).val();
                    let precio = $('#precio');
                    if (cod_producto != 0) {
                        $.ajax({
                            type: 'GET',
                            url: "{{ url('secretaria/precio') }}/" + cod_producto,
                            async: false,
                            success: function (respuesta) {
                                precio.val(respuesta);
                            },
                            error: function (respuesta) {
                              $("#producto").val(0);
                              $("#precio").val(0.00);
                            }
                        });
                    } else {
                        $("#producto").val(0);
                        $("#precio").val(0.00);
                    }
            });

            class Detalle {
                constructor(cantidad,cod_producto,valor){
                    this.cantidad = cantidad,
                    this.cod_producto = cod_producto,
                    this.valor = valor
                }
            }

            var data = [];
            var total = 0;
            var detalles = $("#detalles");
            var mostrarTotal = $("#total");

            $("#agregarProducto").click(function (event) {
                jQuery.validator.addMethod("formato", function (value, element) {
                    return this.optional(element) || /^(\d+|\d+.\d{1,2})$/.test(value);
                }, "La cantidad ingresada no es valida");

                $( "#formDetalle").validate({
                    rules: {
                        cantidad: {
                            required: true,
                            number: true,
                            min: 1,
                            max: 100,
                            step: 1
                        },
                        cod_producto: {
                            required: true,
                        },
                        valor:{
                            required: true,
                            formato: true,
                            range: [0.01,1000],

                        },
                    },
                    submitHandler: function () {
                        let cantidad = $("#cantidad").val();
                        let cod_producto = $("#producto").val();
                        let producto = $("#producto option:selected").text();
                        let valor = $("#precio").val();

                        var detalle = new Detalle(cantidad,cod_producto,valor);

                        var indice = (data.push(detalle) -1);

                        var html = `
                                    <tr>
                                        <td>${detalle.cantidad}</td>
                                        <td>${producto}</td>
                                        <td>&dollar; ${detalle.valor}</td>
                                        <td>&dollar; ${(detalle.valor * detalle.cantidad).toFixed(2)}</td>
                                        <td class="td-actions text-right">
                                            <button type="button" rel="tooltip" class="btn btn-danger eliminar" value="${indice}">
                                               <i class="fa fa-trash fa-2x" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                `;

                        detalles.append(html);
                        total += detalle.cantidad * Math.floor(detalle.valor * 100);
                        mostrarTotal.empty().append(total/100);
                        $("#cantidad").val('');
                        $("#producto").val(0);
                        $("#precio").val(0.00);
                    }
                });
            });


            // eliminar
            $("#detalles").click(function (event) {
                var elemento = $(event.target).parents("td");
                if(elemento.length){
                    let indice = elemento.find("button")[0].value;
                    total -= data[indice].cantidad * Math.floor(data[indice].valor * 100);
                    delete data[indice];
                    elemento.parent().remove();
                    $("#total").empty().append(total/100);
                }
            });

            $("#guardar").click(function (event) {
                event.preventDefault();
                    // Eliminar los items vacios del array antes de enviarlo al server
                data = $.grep(data,function (valor) {
                    return(valor);
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('secretaria.gventa') }}",
                    data: { data: data} ,
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
                        $("#total").empty().append('0.00');
                        total=0;
                        setTimeout(function(){
                            location.reload();
                        }, 2000);
                    },
                    error: function (error) {
                        Command: toastr["error"](error.responseJSON.data);
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": 0,
                            "extendedTimeOut": 0,
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut",
                            "tapToDismiss": false
                        }
                    }
                });
            });

            // CANCELAR
            $("#cancelar").click(function (event) {
                event.preventDefault();
                var confirmar = confirm("Esta seguro de cancelar el ingreso producto al formulario,\n Se perdera toda la información ingresada hasta ahora");
                if(confirmar){
                    $("#detalles").empty();
                    $("#total").empty().append('0.00');
                    total=0;
                }
            });

        });

    </script>
@endsection

