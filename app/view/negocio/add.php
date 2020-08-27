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
            <a class="btn btn-chico btn-default btn-xs" href="<?php echo _SERVER_;?>Negocio/all" >Volver</a>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4 class="header-title">Agregar Nuevo Negocio</h4>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="col-xs-12">
                        <div class="box-body">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label class="col-form-label">Nombre del Negocio</label>
                                    <input type="text" class="form-control" id="negocio_nombre" placeholder="Ingresar Nombre del Negocio...">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label class="col-form-label">Dirección</label>
                                    <input type="text" class="form-control" id="negocio_direccion" placeholder="Ingresar Dirección...">
                                </div>
                            </div>
                        </div>
                            <div class="col-xs-2">
                                <div class="form-group">
                                    <label class="col-form-label">Ciudad</label>
                                    <select class="form-control" id= "negocio_ciudad">
                                        <option value="">Elegir ciudad</option>
                                        <?php
                                        foreach($listaciudad as $l){
                                            ?>
                                            <option value="<?php echo $l->id_ciudad;?>"><?php echo $l->nombre_ciudad;?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="form-group">
                                    <label class="col-form-label">Coordenadas X</label>
                                    <input type="text" onkeypress="return solonumeros(event)" class="form-control" id="negocio_coordenadas_X" placeholder="Ingresar Coordenadas X...">
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="form-group">
                                    <label class="col-form-label">Coordenadas Y</label>
                                    <input type="text" onkeypress="return solonumeros(event)" class="form-control" id="negocio_coordenadas_Y" placeholder="Ingresar Coordenadas Y...">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label class="col-form-label">RUC</label>
                                    <input type="text" onkeypress="return solonumeros(event)" class="form-control" id="negocio_ruc" placeholder="Ingresar Número..." onkeypress="return valida(event)">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label class="col-form-label">Teléfono o Celular</label>
                                    <input type="text" onkeypress="return solonumeros(event)" class="form-control" id="negocio_telefono" placeholder="Ingresar Teléfono o Celular..." onkeypress="return valida(event)">
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" onclick="save()"><i class="fa fa-plus"></i> Agregar Negocio</button>
                                <button class="btn btn-danger" onclick="save()"><i class="fa fa-remove"></i> Cancelar</button>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>negocio.js"></script>
