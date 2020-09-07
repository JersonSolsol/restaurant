<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 18/04/2019
 * Time: 21:05
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
            <li><a href="#"><?php echo $_SESSION['accion'];?></a></li>
            <a class="btn btn-chico btn-default btn-xs" href="<?php echo _SERVER_;?>Negocio/all" >Volver </a>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content" style="background-color: white;box-shadow: 10px 10px 5px #888888;border-radius: 30px; padding: 15px; margin: 50px; min-height: 500px">
        <!-- /.row -->
        <!-- Main row -->
        <br>
        <!-- /.row (main row) -->
            <div class="row">
                <div class="col-xs-10">
                    <center><h1><?php echo $listarnegocios->negocio_nombre; ?></h1></center>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-10">
                    <center><h1><?php echo $listarnegocios->sucursal_nombre; ?></h1></center>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-10">
                    <center><h1><?php echo $listarnegocios->mesa_nombre; ?></h1></center>
                </div>
            </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="col-xs-1"></div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <label class="col-form-label"> Pedidos: </label>
                        <select class="form-control" id="select_pedidos">
                            <option value="" onchange="buscar_producto()">Elegir Pedido</option>
                            <?php
                            foreach($listarproductos as $lp){
                                ?>
                                <option value="<?php echo $lp->id_product;?>"><?php echo $lp->product_name;?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-2">
                    <label for="client_address">Cantidad:</label>
                    <input class="form-control" type="text" id="product_cantb" onchange="onchangeundZ()" value="1" onkeypress="return valida(event);">
                </div>
                <div class="col-xs-2">
                    <label for="client_address">Precio(S/.):</label><br>
                    <input class="form-control" type="text"  onchange="onchangeundpriceZ()" id="product_priceb">
                </div>
                <div class="col-xs-2">
                    <label for="client_address">Total(S/.):</label><br>
                    <input class="form-control" type="text" id="product_totalb" onchange="onchangetotalpriceZ()">
                </div>
                <div class="col-xs-3">
                    <br>
                    <a class="btn btn-success" type="button" onclick="agregarPedido()" ><i class="fa fa-plus"></i> Agregar</a>
                </div>
            </div>

        </div>
        <div id="tabla_productos">

        </div>

    </section>
    <!-- /.content -->
</div>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>pedido.js"></script>

<script>
    $(document).ready(function(){
        $('#tabla_productos').load('<?php echo _SERVER_;?>Pedido/tabla_productos');
        $("#select_pedidos").select2();


    });
    var productfull = "";
    var unid = "";

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
    
    function agregarPedido() {
            var nombre = $("#select_pedidos").val();
            var cantidad = $("#product_cantb").val();
            var precio = $("#product_priceb").val();
            var product_totalb = $("#product_totalb").val();

            var cadena = "nombre=" + nombre +
                "&cantidad=" + cantidad +
                "&precio=" + precio +
                "&product_totalb=" + product_totalb;

                $.ajax({
                    type:"POST",
                    url: urlweb + "api/Pedido/AgregarProducto",
                    data : cadena,
                    success:function (r) {
                        switch (r) {
                            case "1":
                                alertify.success("¡Guardado!");
                                location.href = urlweb +  'Pedido/tabla_prodcutos/'+ id;
                                break;
                            case "2":
                                alertify.error('Hubo Un Error');
                                break;
                            case "3":
                                alertify.error('El Producto YA ESTA AGREGADO');
                                break;
                        }
                    }
                });


        }


</script>