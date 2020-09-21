<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 20/04/2019
 * Time: 18:25
 */
?>
<div class="row">
    <br>
    <br>
    <div class="col-lg-1"></div>

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
                            <td><a type="button" class="btn btn-xs btn-warning btne" onclick="quitarPedido(<?php echo $p[1];?>)" ><i class="fa fa-times"></i></a></td>
                        </tr>
                        <?php
                        $a++;
                    }
                ?>
                </tbody>
            </table>
        </div>
            <div class="row">
                <div class="col-lg-7"></div>
                <div class="col-lg-4">
                    <h4>PRECIO TOTAL: s/.</h4>
                </div>
            </div>

        