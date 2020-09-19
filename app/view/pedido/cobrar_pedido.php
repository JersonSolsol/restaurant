<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 21/04/2019
 * Time: 20:49
 */
?>

<!--Modal para Clientes-->
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Clientes Registrados</h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <a style="float: right" href="<?php echo _SERVER_;?>Client/add" class="btn btn-danger"><i class="fa fa-pencil"></i> Cliente Nuevo</a>
                    <table id="example2" class="table table-bordered table-hover">
                        <thead class="text-capitalize">
                        <tr>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>DNI ó RUC </th>
                            <th>Dirección</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $a = 1;
                        foreach ($clients as $m){
                            ?>
                            <tr>
                                <td><?php echo $m->client_name;?></td>
                                <td><?php echo $m->client_type;?></td>
                                <td><?php echo $m->client_number;?></td>
                                <td><?php echo $m->client_address;?></td>
                                <td><a type="button" class="btn btn-xs btn-success btne" onclick="agregarPersonaPedido('<?php echo $m->client_name;?>',<?php echo $m->client_number;?>,'<?php echo $m->client_address;?>','<?php echo $m->id_client;?>')" ><i class="fa fa-check-circle"></i> Elegir Cliente</a></td>
                            </tr>
                            <?php
                            $a++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

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
    <input type="hidden" id="id_client" value="1">
    <input type="hidden" id="id_pedido" value="<?= $id; ?>">
    <section class="content" style="background-color: white;box-shadow: 10px 10px 5px #888888;border-radius: 30px; padding: 15px; margin: 50px 100px 0 100px; min-height: 500px">
        <!-- /.row -->
        <!-- Main row --><br>
        <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-2">
                <label for="client_number">DNI ó RUC:</label>
                <input class="form-control" type="text" id="client_number" readonly value="11111111">
            </div>
            <div class="col-xs-4">
                <label for="client_name">Nombre del Cliente:</label>
                <input class="form-control" type="text" id="nombre_cliente" readonly>
            </div>
            <div class="col-xs-2">
                <label>Comprobante</label>
                <select id="tipo_pago" class="form-control">
                    <option value="">Elegir Comprobante</option>
                    <option value="BOLETA">BOLETA</option>
                    <option value="FACTURA">FACTURA</option>
                </select>
            </div>
            <div class="col-xs-2" >
                <label>Método de Pago:</label>
                <select onchange="activar_pago()" id="metodo_pago" class="form-control" >
                    <option value="">Elegir PAGO</option>
                    <option value="EFECTIVO">EFECTIVO</option>
                    <option value="TARJETA">TARJETA</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-6">
                <label for="client_address">Direccion:</label>
                <input class="form-control" type="text" id="direccion_cliente" readonly>
            </div>
            <div class="col-xs-2">
                <br>
                <a class="btn btn-success" type="button"  data-toggle="modal" data-target="#basicModal"><i class="fa fa-search"></i> Buscar Cliente</a>
            </div>
            <div class="col-xs-2" id="div_monto_pago">
                <label>Monto: </label>
                <input class="form-control" type="text" id="monto_pago" onchange="monto_pago()">
            </div>
        </div>
        <br>

    <div class="row">
        <div class="col-xs-1"></div>
        <div class="col-lg-10">
            <table class="table table-bordered table-hover" style="border-color: black">
                <thead>
                <tr style="background-color: #ebebeb">
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $totales = count($pedidosale);
                $monto = 0;
                if($totales == 0){
                    ?>
                    <center><h2>Aún no hay productos</h2></center>
                    <?php
                } else {
                    foreach ($pedidosale as $p){
                        $subtotal = 0;
                        $subtotal = $p->detalle_producto_totalprice;
                        $monto = $monto + $subtotal;

                        ?>
                        <tr>
                            <!--<td><?php //echo $p->id_productforsale;?></td>-->
                            <td><?php echo $p->detalle_producto_cantidad;?></td>
                            <td><?php echo $p->detalle_nombre_producto;?></td>
                            <td>S/. <?php echo $p->detalle_precio;?></td>
                            <td>S/. <?php echo $subtotal;?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
            <input type="hidden" id="monto_total" value="<?php echo $monto;?>">
            <?php if($monto!=0){
                ?>
                <div class="row">
                    <div class="col-lg-8"></div>
                    <div class="col-lg-4">
                        <h4>PRECIO TOTAL: s/. <?php echo $monto;?></h4>
                    </div>
                </div>
                <?php
            } ?>
        </div>
    </div>
                <div class="row">
                    <div class="col-xs-8"></div>
                        <div class="col-lg-4" id="pago_con">
                            <h4>PAGO CON: s/. <span id="pago_cliente"> 0.00</h4>
                        </div>
                </div>
                <div class="row">
                    <div class="col-xs-8"></div>
                    <div class="col-lg-4">
                        <h4>VUELTO: s/. <span id="vuelto"> 0.00</span></h4>
                    </div>
                </div>
        <div class="row">
            <div class="col-lg-5"></div>
            <div class="col-lg-3">
                <a class="btn btn-success" type="button" onclick="agregarPedidoFinal()" ><i class="fa fa-money"></i> PAGAR</a>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>pedido.js"></script>

<script>
    $(document).ready(function(){
        $("#div_monto_pago").hide();
    });

    function activar_pago() {
        var metodo = $("#metodo_pago").val();

        if(metodo == "EFECTIVO"){
            $("#div_monto_pago").show();
        }else {
            $("#monto_pago").val("");
            $("#div_monto_pago").hide();
        }
    }

    function monto_pago() {
        var monto_pago = $("#monto_pago").val();
        var cantidad = $("#monto_total").val();
        var vuelto = monto_pago - cantidad;
        vuelto.toFixed(2);
        $("#vuelto").html(vuelto);
        $("#pago_cliente").html(monto_pago);

    }


</script>