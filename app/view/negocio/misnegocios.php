
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Mis Negocios
            <small>Panel Principal</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
                <div class="row">
                    <!-- ./col -->
                    <?php
                    if(!empty($mostrarnegocioUser)){
                        foreach ($mostrarnegocioUser as $m) {
                            ?>
                            <div class="col-xs-12 col-lg-6">
                                <!-- small box -->

                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                        <center><h2><?php echo $m->negocio_nombre; ?></h2></center>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <h2><?php echo $m->role_name; ?></h2>
                                            </div>
                                            <div class="col-xs-2">
                                                <h2><?php echo $m->negocio_date_time; ?></h2>
                                            </div>
                                        </div>

                                    </div>

                                    <a href="#" class="small-box-footer">Usuarios del Sistema <i
                                            class="fa fa-arrow-circle-right"></i></a>
                                </div>

                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <br>
                        <br>
                        <center><h4>NO HAY NEGOCIOS ASIGNADOS A ESTE USUARIO</h4></center>
                        <?php
                    }
                    ?>
                </div>
        </section>
</div>