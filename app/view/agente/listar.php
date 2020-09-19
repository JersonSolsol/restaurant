
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
                <center><h2>Lista de Agente Registrados</h2></center>
            </div>
            <div class="col-xs-2">
                <center><a class="btn btn-block btn-success btn-sm" href="<?php echo _SERVER_;?>Agente/agregarAgente" ><i class="fa fa-plus"></i> Agregar Nuevo Agente</a></center>
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
                        <th>Telefono</th>
                        <th>Accion</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $a = 1;
                    foreach ($agente as $ag){
                        ?>
                        <tr>
                            <td><?php echo $a;?></td>
                            <td> <?php echo $ag->agente_nombre;?></td>
                            <td><?php echo $ag->agente_direccion;?></td>
                            <td><?php echo $ag->agente_telefono;?></td>
                            <td><a type="button" class="btn btn-xs btn-primary btn" href="<?php echo _SERVER_ . 'Agente/editarAgente/' . $ag->id_agente;?>" ><i class="fa fa-pencil"></i> Editar Agente</a><a type="button" class="btn btn-xs btn-danger" onclick="preguntarSiNoAgente(<?php echo $ag->id_agente;?>)"><i class="fa fa-remove"></i> Eliminar</a></td>
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
<script src="<?php echo _SERVER_ . _JS_;?>agente.js"></script>
