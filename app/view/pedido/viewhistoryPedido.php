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
                    foreach ($salesP as $m){
                        $mostrar = "<a class=\"btn btn-xs btn-outline-danger\">PENDIENTE DE PAGO</a>";
                        
                        if($m->pedido_cancelar == 1){
                            $mostrar = "<a class=\"btn btn-xs btn-outline-success\">PAGADO</a>";
                            
                        }
                        ?>
                        <tr>
                            <td><?php echo $totalsales;?></td>
                            <td><?php echo $m->pedido_datetime;?></td>
                            <td><?php echo $m->pedido_correlativo;?></td>
                            <td><?php echo $m->user_nickname;?></td>
                            <td><?php echo $m->client_name;?></td>
                            <td><?php echo $m->client_number;?></td>
                            <td>s/. <?php echo $m->pedido_total;?></td>
                            <td><?php echo $mostrar;?></td>

                            <td>
                                <?php
                                if($m->pedido_cancelar == 0){
                                ?>
                                <a type="button" class= "btn btn-xs btn-danger btne " id="pagar" onchange="pagar_pedido()" href="<?php echo _SERVER_ . 'Pedido/viewpedido/' . $m->id_pedido;?>" target="_blank" >PAGAR</a>
                                <?php
                                } else{
                                ?> 
                                <a type="button" class="btn btn-xs btn-primary btne" id="detalle" onchange="ver_detalle()" href="<?php echo _SERVER_ . 'Pedido/viewpedido/' . $m->id_pedido;?>" target="_blank" >Ver Detalle</a>
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
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>pedido.js"></script>

<script>

    $(document).ready(function(){
        if ($m->pedido_cancelar == 0){
            $("#detalle").hide();
        } else{
            $("#pagar").show();
        }
     

    });

    function pagar_pedido() {
        
    }
    
    function ver_detalle() {
        
    }
    
</script>