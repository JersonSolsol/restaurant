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
                        <h4 class="header-title">Agregar Sucursal</h4>
                        <input type="hidden" id="id_negocio" value="<?= $id; ?>">
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="col-xs-12">
                            <div class="box-body">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Nombre de la Sucursal</label>
                                        <input type="text" class="form-control" id="sucursal_nombre" placeholder="Ingresar Nombre del Negocio...">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Dirección</label>
                                        <input type="text" class="form-control" id="sucursal_direccion" placeholder="Ingresar Dirección...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="form-group">
                                    <label class="col-form-label">Ciudad</label>
                                    <select class="form-control" id= "sucursal_ciudad">
                                        <option value="">Elegir ciudad</option>
                                        <?php
                                        foreach($listciudad as $ls){
                                            ?>
                                            <option value="<?php echo $ls->id_ciudad;?>"><?php echo $ls->nombre_ciudad;?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="form-group">
                                    <label class="col-form-label">Coordenadas X</label>
                                    <input type="text" class="form-control" id="sucursal_coordenadas_X" placeholder="Ingresar Coordenadas X...">
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="form-group">
                                    <label class="col-form-label">Coordenadas Y</label>
                                    <input type="text" class="form-control" id="sucursal_coordenadas_Y" placeholder="Ingresar Coordenadas Y...">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label class="col-form-label">RUC</label>
                                    <input type="text" class="form-control" id="sucursal_ruc" placeholder="Ingresar Número..." onkeypress="return valida(event)">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label class="col-form-label">Teléfono o Celular</label>
                                    <input type="text" class="form-control" id="sucursal_telefono" placeholder="Ingresar Teléfono o Celular..." onkeypress="return valida(event)">
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" onclick="saveSucursal()"><i class="fa fa-plus"></i> Agregar Sucursal</button>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example3" class="table table-bordered table-hover">
                                        <thead class="text-capitalize">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre Sucursal</th>
                                            <th>Direccion</th>
                                            <th>Coordenadas</th>
                                            <th>RUC</th>
                                            <th>Telefono</th>
                                            <th>Accion</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $u = 1;
                                        foreach ( $sucursal as $su) {
                                            ?>
                                            <tr>
                                                <td><?php echo $u; ?></td>
                                                <td><?php echo $su->sucursal_nombre; ?></td>
                                                <td><?php echo $su->sucursal_direccion; ?></td>
                                                <td>X:<?php echo $su->sucursal_coordenadas_X; ?>, Y:<?php echo $su->sucursal_coordenadas_Y; ?></td>
                                                <td><?php echo $su->sucursal_ruc; ?></td>
                                                <td><?php echo $su->sucursal_telefono; ?></td>
                                                <td><a type="button" class="fa fa-remove" onclick="preguntarSiNoSucursal(<?php echo $su->id_sucursal;?>)"></a>
                                                </td>
                                            </tr>
                                            <?php
                                            $u++;
                                        }
                                        ?>
                                        </tbody>

                                    </table>
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
