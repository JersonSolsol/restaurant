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
                        <h4 class="header-title">Editar Negocio</h4>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="col-xs-12">
                            <div class="box-body">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Nombre del Negocio</label>
                                        <input type="text" class="form-control" id="negocio_nombre" placeholder="Ingresar Nombre del Negocio..." value="<?php echo $negocio->negocio_nombre;?>">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Direccion</label>
                                        <input type="text" class="form-control" id="negocio_direccion" value="<?php echo $negocio->negocio_direccion;?>">
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                     <div class="form-group">
                                        <label class="col-form-label">Ciudad</label>
                                        <select class="form-control" id= "negocio_ciudad" >
                                            <option value="">Elegir ciudad</option>
                                            <?php
                                            foreach($listaciudad as $l){
                                                ?>
                                                <option <?php echo ($l->id_ciudad == $negocio->id_ciudad) ? 'selected' : '';?> value="<?php echo $l->id_ciudad;?>"><?php echo $l->nombre_ciudad ;?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label class="col-form-label">Coordenadas X</label>
                                        <input type="text" onkeypress="return solonumeros(event)" class="form-control" id="negocio_coordenadas_X" placeholder="Ingresar Coordenadas X..." value="<?php echo $negocio->negocio_coordenadas_X;?>" onkeypress="return valida(event)">
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label class="col-form-label">Coordenadas Y</label>
                                        <input type="text" onkeypress="return solonumeros(event)" class="form-control" id="negocio_coordenadas_Y" placeholder="Ingresar Coordenadas Y..." value="<?php echo $negocio->negocio_coordenadas_Y;?>" onkeypress="return valida(event)">
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                        <label class="col-form-label">RUC</label>
                                        <input type="text" onkeypress="return solonumeros(event)" class="form-control" id="negocio_ruc" placeholder="Ingresar RUC..." value="<?php echo $negocio->negocio_ruc;?>" onkeypress="return valida(event)">
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                        <label class="col-form-label">Telefono</label>
                                        <input type="text" onkeypress="return solonumeros(event)" class="form-control" id="negocio_telefono" placeholder="Ingresar Teléfono..." value="<?php echo $negocio->negocio_telefono;?>" onkeypress="return valida(event)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success" onclick="save()"><i class="fa fa-pencil"></i> Editar Negocio</button>
                                    <button class="btn btn-danger" href='javascript:history.back()' <i class="fa fa-circle-o-notch"></i> Cancelar</button>
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
<script src="<?php echo _SERVER_ . _JS_;?>negocio.js"></script>

<script>
    $(document).ready(function(){
        $("#negocio_nombre").on('paste', function(e){
            e.preventDefault();
            alert('Esta acción está prohibida');
        })
        $("#negocio_nombre").on('copy', function(e){
            e.preventDefault();
            alert('Esta acción está prohibida');
        })


        $("#negocio_direccion").on('paste', function(e){
            e.preventDefault();
            alert('Esta acción está prohibida');
        })
        $("#negocio_direccion").on('copy', function(e){
            e.preventDefault();
            alert('Esta acción está prohibida');
        })


        $("#negocio_coordenadas_X").on('paste', function(e){
            e.preventDefault();
            alert('Esta acción está prohibida');
        })
        $("#negocio_coordenadas_X").on('copy', function(e){
            e.preventDefault();
            alert('Esta acción está prohibida');
        })


        $("#negocio_coordenadas_Y").on('paste', function(e){
            e.preventDefault();
            alert('Esta acción está prohibida');
        })
        $("#negocio_coordenadas_Y").on('copy', function(e){
            e.preventDefault();
            alert('Esta acción está prohibida');
        })

        $("#negocio_ruc").on('paste', function(e){
            e.preventDefault();
            alert('Esta acción está prohibida');
        })
        $("#negocio_ruc").on('copy', function(e){
            e.preventDefault();
            alert('Esta acción está prohibida');
        })

        $("#negocio_telefono").on('paste', function(e){
            e.preventDefault();
            alert('Esta acción está prohibida');
        })
        $("#negocio_telefono").on('copy', function(e){
            e.preventDefault();
            alert('Esta acción está prohibida');
        })

    });

</script>