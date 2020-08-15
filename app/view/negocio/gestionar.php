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
                <center><h2>Gestionar Usuarios por Negocio</h2></center>
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->

        <div class="row">
            <div class="col-xs-10">
                <center><h1><?php echo $negocio->negocio_nombre;?></h1></center>
                <h2><?php echo $negocio->negocio_direccion;?></h2>
                <h2><?php echo $negocio->negocio_telefono;?></h2>

            </div>
        </div>

            <div class="form-group">
                <input type="hidden" id="id_negocio" value="<?= $id; ?>">
                <label class="col-form-label">USUARIO</label>
                <select class="form-control" id= "id_user" >
                    <option value="">Seleccionar Usuario</option>
                    <?php
                    foreach($usuario as $u){
                        ?>
                        <option <?php echo ($u->id_user == $usuario->id_user) ? 'selected' : '';?> value="<?php echo $u->id_user;?>"><?php echo $u->user_nickname ;?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label class="col-form-label">ROL</label>
                <select class="form-control" id= "id_rol" >
                    <option value="">Seleccionar ROL</option>
                    <?php
                    foreach($rol as $r){
                        ?>
                        <option <?php echo ($r->id_role == $rol->id_role) ? 'selected' : '';?> value="<?php echo $r->id_role;?>"><?php echo $r->role_name ;?></option>
                        <?php

                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-success" onclick="saveRoleUser()">Agregar</button>
            </div>


    </section>
    <!-- /.content -->
</div>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>negocio.js"></script>
