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
            <a class="btn btn-chico btn-default btn-xs" href="<?php echo _SERVER_;?>Agente/all" >Volver</a>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <input type="hidden" id="id_agente" value="<?= $id; ?>">
                    <div class="box-header with-border">
                        <h4 class="header-title">Editar Agentes</h4>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="col-xs-12">
                            <div class="box-body">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Nombre del Agente</label>
                                        <input type="text" class="form-control" id="agente_nombre" placeholder="Ingresar Nombre del Agente..." value="<?php echo $agente->agente_nombre;?>">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Dirección</label>
                                        <input type="text" class="form-control" id="agente_direccion" placeholder="Ingresar Dirección..." value="<?php echo $agente->agente_direccion;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="form-group">
                                    <label class="col-form-label">Ciudad</label>
                                    <select class="form-control" id= "agente_ciudad">
                                        <option value="">Elegir ciudad</option>
                                        <?php
                                        foreach($listaciudad as $l){
                                            ?>
                                            <option <?php echo ($l->id_ciudad == $agente->id_ciudad) ? 'selected' : '';?> value="<?php echo $l->id_ciudad;?>"><?php echo $l->nombre_ciudad ;?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label class="col-form-label">Teléfono o Celular</label>
                                    <input type="text" onkeypress="return solonumeros(event)" class="form-control" id="agente_telefono" placeholder="Ingresar Teléfono o Celular..." onkeypress="return valida(event)" value="<?php echo $agente->agente_telefono;?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <button class="btn btn-success" onclick="editarAgente()"><i class="fa fa-pencil"></i> Editar Agente</button>
                                    <input class="btn btn-danger" type="button" onclick=" location.href='javascript:history.back()' " value="Cancelar" name="boton" />
                                </div>
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
<script src="<?php echo _SERVER_ . _JS_;?>agente.js"></script>
