
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Mis Sucursales
            <small>Panel Principal</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- ./col -->
            <?php
            if(!empty($mostrarsucursal)){
                foreach ($mostrarsucursal as $ms) {
                    ?>
                    <div class="col-xs-12 col-lg-6">
                        <!-- small box -->

                            <div  class="small-box bg-yellow">
                                <div class="inner">
                                    <div class="col-lg-12">
                                    <center><h2><?php echo $ms->sucursal_nombre; ?></h2></center>
                                    </div>
                                </div>

                                <a href="<?php echo _SERVER_ . 'Pedido/seleccionar_mesa/' . $ms->id_sucursal;?>" class="small-box-footer"> Ver Mesas <i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>

                    </div>
                    <?php
                }
            } else {
                ?>
                <br>
                <br>
                <center><h4>NO HAY SUCURSALES ASIGNADOS A ESTE USUARIO</h4></center>
                <?php
            }
            ?>
        </div>
    </section>

</div>