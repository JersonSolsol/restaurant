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
            <li class="active"><?php echo $_SESSION['accion'];?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-xs-10">
                <center><h2>Lista de Negocios Registrados</h2></center>
            </div>
            <div class="col-xs-2">
                <center><a class="btn btn-block btn-success btn-sm" href="<?php echo _SERVER_;?>Negocio/add" ><i class="fa fa-plus"></i> Agregar Nuevo Negocio</a></center>
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-12">
                <table id="example3" class="table table-bordered table-hover">
                    <thead class="text-capitalize">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Coordenadas</th>
                        <th>RUC</th>   
                        <th>Telefono</th>
                        <th>Accion</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $a = 1;
                    foreach ($negocio as $m){
                        ?>
                        <tr>
                            <td><?php echo $a;?></td>
                            <td> <?php echo $m->negocio_nombre;?></td>
                            <td><?php echo $m->negocio_direccion;?></td>
                            <td>X:<?php echo $m->negocio_coordenadas_X;?>, Y:<?php echo $m->negocio_coordenadas_Y;?></td>
                            <td><?php echo $m->negocio_ruc;?></td>                         
                            <td><?php echo $m->negocio_telefono;?></td>
                <td><a type="button" class="btn btn-xs btn-primary btn" href="<?php echo _SERVER_ . 'Negocio/edit/' . $m->id_negocio;?>" ><i class="fa fa-pencil"></i> Editar Negocios</a><a type="button" class="btn btn-xs btn-info btne" href="<?php echo _SERVER_ . 'Negocio/gestionar/' . $m->id_negocio;?>" ><i class="fa fa-user"></i> Gestionar Usuarios</a><a type="button" class="btn btn-xs btn-info btne" href="<?php echo _SERVER_ . 'Negocio/sucursal/' . $m->id_negocio;?>" ><i class="fa fa-user"></i> Gestionar Sucursal</a><a type="button" class="btn btn-xs btn-danger" onclick="preguntarSiNo(<?php echo $m->id_negocio;?>)"><i class="fa fa-remove"></i> Eliminar</a></td>
                        </tr>
                        <?php
                        $a++;
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
<script src="<?php echo _SERVER_ . _JS_;?>negocio.js"></script>
