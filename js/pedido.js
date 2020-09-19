
function quitarPedido(id_nombre) {
    var cadena = "id_nombre=" + id_nombre;
    $.ajax({
        type:"POST",
        url: urlweb + "api/Pedido/deletePedido",
        data : cadena,
        success:function (r) {
            if(r==1){
                alertify.success('Producto Eliminado');
                $('#tabla_productos').load(urlweb + 'Pedido/tabla_productos');
            } else {
                alertify.error('Hubo Un Error');
            }
        }
    });
}

function preguntarSiNoMenu(total){
    var id_mesa = $('#id_mesa').val();
    var saleproduct_total = total;
    alertify.confirm('Realizar Venta', '¿Esta seguro que desea realizar esta venta? Monto Total: s/.' + saleproduct_total,
        function(){ venderMenu(id_mesa , saleproduct_total) }
        , function(){ alertify.error('Operacion Cancelada')});
}

function venderMenu(id_mesa, saleproduct_total){
    var cadena = "id=" + id_mesa +
        "&pedido_total=" + saleproduct_total;
    $.ajax({
        type:"POST",
        url: urlweb + "api/Pedido/PedidoProductos",
        data : cadena,
        success:function (r) {
            if(r!=2){
                alertify.success('Venta Realizada');
                location.href = urlweb + 'Pedido/viewpedido/' + r;

            } else {
                alertify.error('No se pudo llevar acabo la venta');
            }
        }
    });
}

function agregarPedidoFinal(){
    var valor = "correcto";
    var ventas_comprobante = $("#tipo_pago").val();
    var ventas_metodopago = $("#metodo_pago").val();
    var ventas_monto = $("#monto_pago").val();
    var id = $("#id_pedido").val();
    var id_client = $("#id_client").val();


    if(ventas_metodopago == ""){
        alertify.error('El campo Usuario no fue seleccionado');
        $('#metodo_pago').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#metodo_pago').css('border','');
    }

    if(ventas_monto == ""){
        alertify.error('El campo Usuario no fue seleccionado');
        $('#monto_pago').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#monto_pago').css('border','');
    }

    if (valor == "correcto") {
        var cadena = "ventas_comprobante=" + ventas_comprobante +
            "&ventas_metodopago=" + ventas_metodopago +
            "&ventas_monto=" + ventas_monto +
            "&id="+ id +
            "&id_client=" + id_client;

        $.ajax({
            type: "POST",
            url: urlweb + "api/Pedido/save_ventaPedido",
            data: cadena,
            success: function (r) {
                if (r != 2) {
                    alertify.success('Venta Realizada');
                    location.href = urlweb + 'Pedido/viewhistoryPedido/' + r;

                } else {
                    alertify.error('No se pudo llevar acabo la venta');
                }
            }
        });
    }
}

function preguntarSiNoPedido(id_pedido){
    alertify.confirm('Anular Venta', '¿Esta seguro que desea anular esta venta? Una vez realizado, no se podrá deshacer.',
        function(){ anular(id_pedido) }
        , function(){ alertify.error('Operacion Cancelada')});
}

function anular(id_pedido){
    var cadena = "id_pedido=" + id_pedido;
    $.ajax({
        type:"POST",
        url: urlweb + "api/Pedido/revokeSalePedido",
        data : cadena,
        success:function (r) {
            if(r!=2){
                alertify.success('Venta Anulada');
                location.href = urlweb + 'Pedido/viewhistoryPedido/';
            } else {
                alertify.error('No se pudo anular la venta');
            }
        }
    });
}

function agregarPersonaPedido(nombre, numero, direccion, id) {
    $("#client_number").val(numero);
    $("#nombre_cliente").val(nombre);
    $("#direccion_cliente").val(direccion);
    $("#id_client").val(id);

    alertify.success('El cliente se agregó correctamente!');

}

function preguntarSiNoPedido(id_pedido_detalle){
    alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este registro?',
        function(){ deletePedido(id_pedido_detalle) }
        , function(){ alertify.error('Operacion Cancelada')});
}

function deletePedido(id_pedido_detalle){
    var cadena = "id_pedido_detalle=" + id_pedido_detalle;
    $.ajax({
        type:"POST",
        url: urlweb + "api/Pedido/deletePedidoA",
        data : cadena,
        success:function (r) {
            if(r==1){
                alertify.success('Pedido Eliminado');
                location.reload();
            } else {
                alertify.error('No se pudo realizar');
            }
        }
    });
}

function agregarPedidoEdit(){

    var valor = "correcto";
    var id = $('#id_pedido').val();
    var id_productforsale = $('#select_pedidos').val();
    var detalle_nombre_producto = $('#select_pedidos option:selected').text();
    var detalle_unidad = $('#product_cantb').val();
    var detalle_precio = $('#product_priceb').val();
    var detalle_producto_totalprice = $('#product_totalb').val();

    if (valor == "correcto"){
        var cadena = "id=" + id +
            "&id_productforsale=" + id_productforsale +
            "&detalle_nombre_producto=" + detalle_nombre_producto +
            "&detalle_unidad=" + detalle_unidad +
            "&detalle_precio=" + detalle_precio +
            "&detalle_producto_totalprice=" + detalle_producto_totalprice;

            $.ajax({
            type:"POST",
            url: urlweb + "api/Pedido/savePedidoEdit",
            data: cadena,
            success:function (r) {
                switch (r) {
                    case "1":
                        alertify.success("¡Pedido Guardado!");
                        location.reload();
                        break;
                    case "2":
                        alertify.error("Fallo el envio");
                        break;
                    case "3":
                        alertify.error("El Nombre de la sucursal ya existe");
                        break;
                    default:
                        alertify.error("ERROR DESCONOCIDO");
                }
            }
        });

    }
}


function editarPedido(){

    var valor = "correcto";
    var id = $('#id_pedido').val();
    var id_productforsale = $('#select_pedidos').val();
    var detalle_nombre_producto = $('#select_pedidos option:selected').text();
    var detalle_unidad = $('#product_cantb').val();
    var detalle_precio = $('#product_priceb').val();
    var detalle_producto_totalprice = $('#product_totalb').val();
    var id_pedido_detalle = $("#id_pedido_detalle").val();

    if (valor == "correcto"){
        var cadena = "id=" + id +
            "&id_productforsale=" + id_productforsale +
            "&detalle_nombre_producto=" + detalle_nombre_producto +
            "&detalle_unidad=" + detalle_unidad +
            "&detalle_precio=" + detalle_precio +
            "&detalle_producto_totalprice=" + detalle_producto_totalprice +
            "&id_pedido_detalle=" + id_pedido_detalle;

        $.ajax({
            type:"POST",
            url: urlweb + "api/Pedido/savePedidoEdit",
            data: cadena,
            success:function (r) {
                switch (r) {
                    case "1":
                        alertify.success("¡Pedido Guardado!");
                        location.reload();
                        break;
                    case "2":
                        alertify.error("Fallo el envio");
                        break;
                    case "3":
                        alertify.error("El Nombre del Pedido ya existe");
                        break;
                    default:
                        alertify.error("ERROR DESCONOCIDO");
                }
            }
        });

    }
}
