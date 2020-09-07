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
    <section class="content">
        <!-- /.row -->
        <!-- Main row -->
        <br>
        <!-- /.row (main row) -->

        <div class="row">
            <div class="col-xs-10">
                <center><h1><?php echo $listsucursal->negocio_nombre; ?></h1></center>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-10">
                <center><h1><?php echo $listsucursal->sucursal_nombre; ?></h1></center>
            </div>
        </div>
        <div class="row">
            <?php
            foreach ( $mesa as $m) {
            ?>
            <div class="col-xs-12 col-lg-3">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <div class="col-lg-12">
                        <center><h2><?php echo $m->mesa_nombre; ?></h2></center>
                        </div>
                    </div>
                    <a href="<?php echo _SERVER_ . 'Pedido/realizar_pedido/' . $m->id_mesa;?>" class="small-box-footer"> Seleccionar Pedido <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
                <?php
            }
            ?>

        </div>
















    </section>
    <!-- /.content -->
</div>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>pedido.js"></script>