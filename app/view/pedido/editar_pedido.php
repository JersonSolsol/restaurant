<?php
/**
 * Created by PhpStorm
 * User: Jerson Solsol
 * Date: 14/09/2020
 * Time: 20:49
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $_SESSION['controlador'];?>
            <small><?php echo $_SESSION['accion'];?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="<?php echo $_SESSION['icono'];?>"></i><?php echo $_SESSION['controlador'];?></a></li>
            <li class="active"><?php echo $_SESSION['accion'];?></li>
        </ol>
    </section>
        <div class="row">
            <div class="col-xs-12">
                <div class="col-xs-1"></div>
                <div class="col-xs-2">
                    <input type="hidden" id="id_pedido" value="<?= $id; ?>">
                    <input type="hidden" id="id_pedido_detalle" value="">
                    <div class="form-group">
                        <label class="col-form-label"> Pedidos: </label>
                        <select class="form-control" onchange="buscar_producto()" id="select_pedidos">
                            <option value="0" >Elegir Pedido</option>
                            <?php
                            foreach($listarproductos as $lp){
                                ?>
                                <option value="<?php echo $lp->id_productforsale;?>"><?php echo $lp->product_name;?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-2">
                    <label for="client_address">Cantidad:</label>
                    <input class="form-control" onkeypress="return solonumeros(event)" type="text" id="product_cantb" onchange="onchangeundZ()" onkeypress="return valida(event);">
                </div>
                <div class="col-xs-2">
                    <label for="client_address">Precio(S/.):</label><br>
                    <input class="form-control" onkeypress="return solonumeros(event)" type="text"  onchange="onchangeundpriceZ()" id="product_priceb" readonly>
                </div>
                <div class="col-xs-2">
                    <label for="client_address">Total(S/.):</label><br>
                    <input class="form-control" onkeypress="return solonumeros(event)" type="text" id="product_totalb" value="" onchange="onchangetotalpriceZ()" readonly>
                </div>
                <div class="col-xs-3">
                    <br>
                    <a class="btn btn-success" id="btn_guardar_pedido" type="button" onclick="agregarPedidoEdit()" ><i class="fa fa-plus"></i> Agregar</a>
                    <a class="btn btn-primary" id="btn_editar_pedido" type="button" onclick="editarPedido()" ><i class="fa fa-pencil"></i> Editar</a>
                    <a class="btn btn-danger" id="btn_cancelar_pedido" type="button" onclick="cancelar_pedido()" ><i class="fa fa-trash"></i> Cancelar</a>
                </div>
            </div>

        </div>

        <div id="tabla_productos2">
            <div class="col-lg-10">
                <table class="table table-bordered table-hover" style="border-color: black">
                    <thead>
                    <tr style="background-color: #ebebeb">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                        <th>Accion</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $a = 1;
                        foreach ($editpedido as $ep){
                            ?>
                            <tr>
                                <td><?php echo $a; ?></td>
                                <td><?php echo $ep->detalle_nombre_producto;?></td>
                                <td><?php echo $ep->detalle_unidad;?></td>
                                <td>s/. <?php echo $ep->detalle_precio;?></td>
                                <td>s/. <?php echo $ep->detalle_producto_totalprice;?></td>
                                <td><a type="button" class="btn btn-xs btn-warning btne" onclick="preguntarSiNoPedido(<?php echo $ep->id_pedido_detalle;?>)" ><i class="fa fa-times"></i> QUITAR PEDIDO</a><a id="btn_editar_<?= $ep->id_detalle_pedido ?>" type="button" class="btn btn-xs btn-primary" onclick="activarEdicionPedido(<?php echo $ep->id_productforsale;?>,'<?php echo $ep->id_pedido_detalle;?>','<?php echo $ep->detalle_nombre_producto;?>','<?php echo $ep->detalle_unidad;?>','<?php echo $ep->detalle_precio;?>','<?php echo $ep->detalle_producto_totalprice;?>')"><i class="fa fa-pencil"></i> Editar</a></td>
                            </tr>
                            <?php
                            $a++;
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>



</div>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>pedido.js"></script>

<script>
 $(document).ready(function(){
      //  $('#tabla_productos2').load('<?php echo _SERVER_;?>Pedido/tabla_productos2');
        $("#select_pedidos").select2();
        $("#btn_editar_pedido").hide();
        $("#btn_cancelar_pedido").hide();

    });

 function buscar_producto() {
        var valor = "correcto";
        var select_pedidos = $('#select_pedidos').val();
        if(select_pedidos == ""){
            alertify.error('El campo Pedido está vacío');
            $('#select_pedidos').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#select_pedidos').css('border','');
        }

        if (valor == "correcto"){
            var cadena = "select_pedidos=" + select_pedidos;
            $.ajax({
                type:"POST",
                url: urlweb + "api/Pedido/search_by_producto",
                data: cadena,
                success:function (r) {

                    if(r=="2"){
                        alertify.error("ERROR O PRODUCTO NO REGISTRADO");
                        $('#product_priceb').val('');
                        $('#product_totalb').val('');
                        $('#product_cantb').val(1);
                        productfull = "";
                        unid = "";
                    } else {
                        var productoinfo = r.split('|');
                        $('#select_pedidos').val();
                        $('#product_priceb').val(productoinfo[5]);
                        $('#product_totalb').val(productoinfo[5]);
                        $('#product_cantb').val(1);
                        alertify.success('PRODUCTO ENCONTRADO');
                    }
                }
            });
        }
    }

    function onchangeundZ() {
        var cant = $("#product_cantb").val();
        var precio = $("#product_priceb").val();
        var subtotal = cant * precio;
        subtotal.toFixed(2);
        $("#product_totalb").val(subtotal);
    }

    function onchangeundpriceZ() {
        var cant = $("#product_cantb").val();
        var precio = $("#product_priceb").val();
        var subtotal = cant * precio;
        subtotal.toFixed(2);
        subtotal = parseFloat(subtotal);
        $("#product_totalb").val(subtotal);
    }

    function onchangetotalpriceZ() {
        var subtotal = $("#product_totalb").val();
        var cant = $("#product_cantb").val();
        var precio = subtotal / cant;
        precio.toFixed(2);
        $("#product_priceb").val(precio);
    }

     function activarEdicionPedido(id, id_pedido_detalle, nombre, cantidad, precio, total) {
         $("#select_pedidos").val(id);
         $("#select_pedidos option[value="+ id +"]").attr("selected",true);
         $("#select_pedidos").select2().trigger('change');
         $("#btn_guardar_pedido").hide();
         $("#btn_editar_pedido").show();
         $("#btn_cancelar_pedido").show();
         $("#id_pedido_detalle").val(id_pedido_detalle);
         $("#product_cantb").val(cantidad);
         $("#product_priceb").val(precio);
         $("#product_totalb").val(total);

     }

     function cancelar_pedido() {
         $("#btn_guardar_pedido").show();
         $("#btn_editar_pedido").hide();
         $("#btn_cancelar_pedido").hide();

         $("#select_pedidos").val("");
         $("#product_cantb").val("");
         $("#product_priceb").val("");
         $("#product_totalb").val("");
         var valor = $("#sucursal_ciudad").val();

         $("#select_pedidos option[value="+ valor +"]").attr("selected",false);
         $("#select_pedidos option[value=0]").attr("selected",true);
     }


</script>