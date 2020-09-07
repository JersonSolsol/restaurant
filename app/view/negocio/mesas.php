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
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">

            <div class="col-xs-10">
                <center><h2>Gestionar Mesas por Negocio</h2></center>
            </div>
        </div>
        <div class = "row">
            <div class="col-md-12">
                <div class="col-xs-4">
                    <h2><?php echo $sucursal->sucursal_nombre;?></h2>
                </div>
                <div class="col-xs-4">
                    <h2><?php echo $sucursal->sucursal_direccion;?></h2>
                </div>
                <div class="col-xs-4">
                    <h2><?php echo $sucursal->sucursal_telefono;?></h2>
                </div>
                <div class="col-xs-4">
                    <h2><?php echo $sucursal->negocio_nombre;?></h2>
                </div>
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->

        <div class="row">

            <div class="col-xs-10">
                <center><h1></h1></center>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-xs-3">
                <div class="form-group">
                    <input type="hidden" id="id_sucursal" value="<?= $id; ?>">
                    <input type="hidden" id="id_mesa" value="">
                    <label class="col-form-label">MESAS</label>
                    <input type="text" class="form-control" id="mesa_nombre" placeholder="Ingresar Nombre de la Mesa..">
                </div>
            </div>
            <div class="col-xs-3">
                <br>
                    <button id="btn_agregar_mesa" class="btn btn-success" onclick="saveMesas()"><i class="fa fa-plus"></i> Agregar Mesa</button>
                    <button id="btn_editar_mesa" class="btn btn-primary" onclick="editMesas()"><i class="fa fa-pencil"></i> Editar Mesa</button>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <table class="table table-bordered table-hover">
                        <thead class="text-capitalize">
                        <tr>
                            <th>Mesa</th>
                            <th>Accion</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ( $mesas as $m) {

                            ?>
                            <tr>
                                <td><?php echo $m->mesa_nombre; ?></td>
                                <td><a id="btn_editar<?= $m->id_mesa ?>" type="button" class="btn btn-xs btn-primary" onclick="activarEdicionMesas(<?php echo $m->id_mesa;?>,'<?php echo $m->mesa_nombre; ?>')" ><i class="fa fa-pencil"></i> Editar Mesas</a><a type="button" class="btn btn-xs btn-danger" onclick="preguntarSiNoMesa(<?php echo $m->id_mesa;?>)"> Eliminar</a >
                                    <?php
                                    if ($m->mesa_estado == 0) {
                                        ?>
                                        <a id="btn_deshabilitar<?= $m->id_mesa ?>" type="button" class="btn btn-xs btn-success"
                                           onclick="habilitar(<?= $m->id_mesa ?>,1)">DESHABILITAR</a>
                                        <?php
                                    }else{
                                        ?>
                                        <a id="btn_habilitar<?= $m->id_mesa ?>" type="button" class="btn btn-xs btn-success"
                                           onclick="habilitar(<?= $m->id_mesa ?>,0)">HABILITAR</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>

    </section>
    <!-- /.content -->
</div>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>negocio.js"></script>

<script>
    $(document).ready(function(){
        $("#btn_editar_mesa").hide();

    });

    function activarEdicionMesas(id_mesa, nombre) {
        $("#btn_agregar_mesa").hide();
        $("#btn_editar_mesa").show();


        $("#mesa_nombre").val(nombre);
        $("#id_mesa").val(id_mesa);
    }

    function habilitar(id, estado) {

        var cadena = "id=" + id +
                "&mesa_estado=" + estado;
        $.ajax({
            type:"POST",
            url: urlweb + "api/Negocio/cambiarEstado",
            data : cadena,
            success:function (r) {
                if(r==1){
                    alertify.success('Estado Cambiado');
                    location.reload();
                } else {
                    alertify.error('No se pudo realizar el Cambio');
                }
            }
        });

    }


</script>