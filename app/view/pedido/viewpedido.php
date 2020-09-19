<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 21/04/2019
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

    <!-- Main content -->
    <section class="content" style="background-color: white;box-shadow: 10px 10px 5px #888888;border-radius: 30px; padding: 15px; margin: 50px 100px 0 100px; min-height: 500px">
        <!-- /.row -->
        <!-- Main row --><br>
        <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-4">
                <p><i class="fa fa-calendar"></i> Fecha del Pedido: <?php echo $pedido->pedido_datetime;?></p>
                <p><i class="fa fa-user"></i> Nombre Del Cliente: <?php echo $pedido->client_name;?></p>
            </div>
            <div class="col-xs-3">
                <p style="color:red;">Código: <?php echo $pedido->pedido_correlativo;?></p>
            </div>
            <div class="col-xs-4">
                <?php
                $id_turn = $this->active->getTurnactive();
                if($pedido->pedido_cancelar == 1){
                    ?>
                    <p style="color: green; float: right;"><i class="fa fa-check-circle"></i> Venta Realizada Correctamente</p>
                    <?php
                    if($id_turn == $pedido->id_turn){
                        ?>
                        <a type="button" class="btn btn-xs btn-danger" style="float: right" onclick="preguntarSiNoPedido(<?php echo $pedido->id_pedido;?>)"><i class="fa fa-times-circle"></i> Anular Venta</a>
                        <?php
                    }
                } else {
                    ?>
                    <p style="color: green; float: right;"><i class="fa fa-check-circle"></i> Pedido Registrado Correctamente</p>
                    <?php
                }
                ?>
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->
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
                    <tfoot>
                    <tr>
                        <td colspan="3" style="text-align:right;">PRECIO TOTAL</td>
                        <?php $num_ = explode(".",$monto);
                        $dec = round($num_[1],2);
                        if(strlen($dec)==1){
                            $dec = $dec ."0";
                            ($dec==0) ? $monto = $monto.".00": $monto = $monto."0";
                        } ?>
                        <td style="background-color: #f9f17f; font-weight: bold">S/. <?php echo $monto;?></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5"></div>
            <div class="col-lg-3">
                <?php
                if($cobrar->pedido_cancelar == 0){
                ?>
                <a class="btn btn-primary" target="_blank" href="<?php echo _SERVER_ . 'Pedido/cobrarPedido/'.$p->id_pedido;?>"><i class="fa fa-money"></i> COBRAR</a>
                    <a class="btn btn-success" href="<?php echo _SERVER_ . 'Pedido/editar_pedido/' . $p->id_pedido;?>"><i class="fa fa-pencil"></i> EDITAR</a>
                    <?php
                }
                ?>

            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>pedido.js"></script>
