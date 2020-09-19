<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 20/04/2019
 * Time: 18:25
 */
?>
<div class="row">
    <div class="col-xs-9"></div>
    <div class="col-xs-3">
        <a class="btn btn-primary btn-xs" type="button"  data-toggle="modal" data-target="#largeModal"><i class="fa fa-search"></i> Buscar Producto</a>
    </div><br><br>
    <div class="col-lg-1"></div>

        <div class="col-lg-10">
            <?php
            $totales = count($_SESSION['pedidos']);
            ?>
            <table class="table table-bordered table-hover" style="border-color: black">
                <thead>
                <tr style="background-color: #ebebeb">
                    <th>ID</th>
                    <th>Nombre <?= $totales; ?></th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                    <th>Accion</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $totales = count($_SESSION['pedidos']);
                $monto = 0;
                $a = 1;
                if($totales == 0){

                } else {
                    foreach ($_SESSION['pedidos'] as $p){
                        $subtotal = round($p[3] * $p[4],2);
                        $monto = $monto + $subtotal;
                        ?>
                        <tr>
                            <td><?php echo $a; ?></td>
                            <td><?php echo $p[2];?></td>
                            <td><?php echo $p[3];?></td>
                            <td>s/. <?php echo $p[4];?></td>
                            <td>s/. <?php echo $subtotal;?></td>
                            <td><a type="button" class="btn btn-xs btn-warning btne" onclick="quitarPedido(<?php echo $p[1];?>)" ><i class="fa fa-times"></i> Quitar</a></td>
                        </tr>
                        <?php
                        $a++;
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php if($monto!=0){
            ?>
            <div class="row">
                <div class="col-lg-7"></div>
                <div class="col-lg-4">
                    <h4>PRECIO TOTAL: s/. <?php echo $monto;?></h4>
                    <a type="button" class="btn btn-danger" onclick="preguntarSiNoMenu(<?php echo $monto;?>)" ><i class="fa fa-money"></i> Generar Pedido</a>
                </div>
            </div>

            <?php
        } ?>