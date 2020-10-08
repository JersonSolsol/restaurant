<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 22/04/2019
 * Time: 12:26
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
    <section class="content">
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-xs-10">
                <center><h2>Lista de Pedidos Registrados</h2></center>
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->
        <div class="row">

            <input type="hidden" id="fecha_filtro_i" name="fecha_filtro_i" value="<?php echo $fecha_filtro_i;?>">
            <input type="hidden" id="fecha_filtro_f" name="fecha_filtro_f" value="<?php echo $fecha_filtro_f;?>">

            <form method="post" action="<?= _SERVER_ ?>Pedido/melendez">
                <input type="hidden" id="enviar" name="enviar" value="1">
            <div class="col-md-3">
                <label for="fecha_i">Desde:</label>
                <input type="date" class="form-control" id="fecha_i" name="fecha_i" value="<?php echo $fecha;?>">
            </div>
            <div class="col-md-3">
                <label for="fecha_f">Hasta:</label>
                <input type="date" class="form-control" id="fecha_f" name="fecha_f" value="<?php echo $fecha;?>">
            </div>
            <div class="col-xs-2">
                <div class="form-group">
                    <label class="col-form-label">Usuario:</label>
                    <select class="form-control" id="usuario" name="usuario">
                        <option value="">Elegir Usuario</option>
                        <?php
                        foreach($usuarios as $u){
                            if($usuario == $u->id_user ){
                                $sele = "selected";
                            }else{
                                $sele="";
                            }
                            ?>
                            <option value="<?php echo $u->id_user;?>" <?= $sele; ?>><?php echo $u->user_nickname ;?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="form-group">
                    <label class="col-form-label">Estado:</label>
                    <select class="form-control" id= "estado_pedido" name="estado_pedido">
                        <option <?php $estado3 ; ?> value="">Elegir Estado</option>
                        <?php
                        if ($estado_pedido == "0"){
                            $estado = "selected";
                        } else if ($estado_pedido == "1") {
                            $estado2 = "selected";
                        } else{
                            $estado3 = "";
                        }
                        ?>
                        <option <?= $estado; ?> value="0">PENDIENTE</option>
                        <option <?= $estado2; ?> value="1">PAGADO</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="col-xs-2">
                <a><button class="btn btn-success" onclick=""><i class="fa fa-search"></i> BUSCAR</button></a>
            </div>
            </form>
        </div>
        <?php
        if($datos) {
            ?>
                <div class="col-lg-12">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead class="text-capitalize">
                        <tr>
                            <th>N°</th>
                            <th>Fecha</th>
                            <th>COD</th>
                            <th>Usuario Vendedor</th>
                            <th>Cliente</th>
                            <th>DNI ó RUC</th>
                            <th>Total de Venta</th>
                            <th>Estado Venta</th>
                            <th>Detalles</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $totalsales = count($salesP);
                        foreach ($salesP as $m) {
                            $mostrar = "<a class=\"btn btn-xs btn-outline-danger\">PENDIENTE DE PAGO</a>";

                            if ($m->pedido_cancelar == 1) {
                                $mostrar = "<a class=\"btn btn-xs btn-outline-success\">PAGADO</a>";

                            }
                            ?>
                            <tr>
                                <td><?php echo $totalsales; ?></td>
                                <td><?php echo $m->pedido_datetime; ?></td>
                                <td><?php echo $m->pedido_correlativo; ?></td>
                                <td><?php echo $m->user_nickname; ?></td>
                                <td><?php echo $m->client_name; ?></td>
                                <td><?php echo $m->client_number; ?></td>
                                <td>s/. <?php echo $m->pedido_total; ?></td>
                                <td><?php echo $mostrar; ?></td>

                                <td>
                                    <?php
                                    if ($m->pedido_cancelar == 0) {
                                        ?>
                                        <a type="button" class="btn btn-xs btn-danger btne " id="pagar"
                                           onchange="pagar_pedido()"
                                           href="<?php echo _SERVER_ . 'Pedido/viewpedido/' . $m->id_pedido; ?>"
                                           target="_blank">PAGAR</a>
                                        <?php
                                    } else {
                                        ?>
                                        <a type="button" class="btn btn-xs btn-primary btne" id="detalle"
                                           onchange="ver_detalle()"
                                           href="<?php echo _SERVER_ . 'Pedido/viewpedido/' . $m->id_pedido; ?>"
                                           target="_blank">Ver Detalle</a>
                                        <?php
                                    }
                                    ?>
                                </td>

                            </tr>
                            <?php
                            $totalsales--;
                        }
                        ?>
                        </tbody>
                    </table>
                    <center><a  onclick="enviarDatos()" target="_blank" class="btn btn-primary"><i class="fa fa-download"></i> Generar PDF</a><a id="btnExportar" onclick="descargarExcel()" target="_blank" class="btn btn-success"><i class="fa fa-download"></i> Generar Excel</a></center>
                </div>
            <?php
        }
        ?>
    </section>
</div>


<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>pedido.js"></script>


<script>

    function enviarDatos() {
        var valor = "correcto";
        var fecha_i = $('#fecha_filtro_i').val();
        var fecha_f  = $('#fecha_filtro_f').val();
        var usuario = $('#usuario').val();
        var estado_pedido = $('#estado_pedido').val();

        if (valor == "correcto"){
        var cadena = "fecha_i=" + fecha_i +
                "&fecha_f=" + fecha_f +
                "&usuario=" + usuario +
                "&estado_pedido=" + estado_pedido;











            $.ajax({
                type:"POST",
                url: urlweb + "Pedido/pedidoPDF",
                data: cadena,
                    success:function (r) {
                        switch (r) {
                            case "1":
                                alertify.success("¡Guardado!");
                                location.reload();
                                break;
                            case "2":
                                alertify.error("Fallo el envio");
                                break;
                            case "3":
                                alertify.error("El Nombre del negocio ya existe");
                                break;
                            default:
                                alertify.error("ERROR DESCONOCIDO");
                        }
                    }
            });
        }
    }

</script>