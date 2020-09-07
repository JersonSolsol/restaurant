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
                    <input type="hidden" id="id_sucursal" value="<?= $id_sucursal; ?>">
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
                                        <input type="text" onkeydown="limitText(this,60)" class="form-control" id="sucursal_nombre" placeholder="Ingresar Nombre del Negocio...">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Dirección</label>
                                        <input type="text" onkeydown="limitText(this,80)" class="form-control" id="sucursal_direccion" placeholder="Ingresar Dirección...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="form-group">
                                    <label class="col-form-label">Ciudad</label>
                                    <select class="form-control" id= "sucursal_ciudad">
                                        <option value="0">Elegir ciudad</option>
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
                                    <input type="text" onkeypress="return solonumeros(event)" class="form-control" id="sucursal_coordenadas_X" placeholder="Ingresar Coordenadas X...">
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="form-group">
                                    <label class="col-form-label">Coordenadas Y</label>
                                    <input type="text" onkeypress="return solonumeros(event)" class="form-control" id="sucursal_coordenadas_Y" placeholder="Ingresar Coordenadas Y...">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label class="col-form-label">RUC</label>
                                    <input type="text" onkeypress="return solonumeros(event)" class="form-control" id="sucursal_ruc" placeholder="Ingresar Número..." onkeypress="return valida(event)">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label class="col-form-label">Teléfono o Celular</label>
                                    <input type="text" onkeypress="return solonumeros(event)" class="form-control" id="sucursal_telefono" placeholder="Ingresar Teléfono o Celular..." onkeypress="return valida(event)">
                                </div>
                            </div>
                            <div class="form-group">
                                <button id="btn_agregar_sucursal" class="btn btn-success" onclick="saveSucursal()"><i class="fa fa-plus"></i> Agregar Sucursal</button>
                                <button id="btn_editar_sucursal" class="btn btn-primary" onclick="editSucursal()"><i class="fa fa-pencil"></i> Editar Sucursal</button>
                                <button id="btn_cancelar" class="btn btn-danger" onclick="cancelar()"><i class="fa fa-pencil"></i> Cancelar</button>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example3" class="table table-bordered table-hover">
                                        <thead class="text-capitalize">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre Sucursal</th>
                                            <th>Ciudad</th>
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
                                                <td><?php echo $su->nombre_ciudad; ?></td>
                                                <td><?php echo $su->sucursal_direccion; ?></td>
                                                <td>X:<?php echo $su->sucursal_coordenadas_X; ?>, Y:<?php echo $su->sucursal_coordenadas_Y; ?></td>
                                                <td><?php echo $su->sucursal_ruc; ?></td>
                                                <td><?php echo $su->sucursal_telefono; ?></td>
                                                <td><a id="btn_eliminar_sucursal_<?= $su->id_sucursal ?>" type="button" class="btn btn-xs btn-danger" onclick="preguntarSiNoSucursal(<?php echo $su->id_sucursal;?>)"><i class="fa fa-remove"></i> Eliminar</a><a id="btn_editar_<?= $su->id_sucursal ?>" type="button" class="btn btn-xs btn-primary" onclick="activarEdicion(<?php echo $su->id_sucursal;?>,'<?php echo $su->sucursal_nombre; ?>','<?php echo $su->sucursal_direccion; ?>','<?php echo $su->id_ciudad; ?>','<?php echo $su->sucursal_coordenadas_X; ?>','<?php echo $su->sucursal_coordenadas_Y; ?>','<?php echo $su->sucursal_ruc; ?>','<?php echo $su->sucursal_telefono; ?>')"><i class="fa fa-pencil"></i> Editar</a><a type="button" class="btn btn-xs btn-info btne" href="<?php echo _SERVER_ . 'Negocio/mesas/' . $su->id_sucursal;?>" ><i class="fa fa-user"></i> Asignar Mesas</a>
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

<script>
    $(document).ready(function(){
        $("#btn_editar_sucursal").hide();
        $("#btn_cancelar").hide();

    });
    function activarEdicion(id_sucursal,nombre,direccion, ciudad, coor_X,coor_Y,ruc,telefono) {
        $("#btn_agregar_sucursal").hide();
        $("#btn_editar_sucursal").show();
        $("#btn_cancelar").show();

        $("#sucursal_nombre").val(nombre);
        $("#sucursal_direccion").val(direccion);

        $("#sucursal_ciudad option[value="+ ciudad +"]").attr("selected",true);

        $("#sucursal_coordenadas_X").val(coor_X);
        $("#sucursal_coordenadas_Y").val(coor_Y);
        $("#sucursal_ruc").val(ruc);
        $("#sucursal_telefono").val(telefono);
        $("#id_sucursal").val(id_sucursal);


    }

    function cancelar() {
        $("#btn_agregar_sucursal").show();
        $("#btn_editar_sucursal").hide();
        $("#btn_cancelar").hide();

        $("#sucursal_nombre").val("");
        $("#sucursal_direccion").val("");
        $("#sucursal_coordenadas_X").val("");
        $("#sucursal_coordenadas_Y").val("");
        $("#sucursal_ruc").val("");
        $("#sucursal_telefono").val("");
        $("#id_sucursal").val("");
        var valor = $("#sucursal_ciudad").val();

        $("#sucursal_ciudad option[value="+ valor +"]").attr("selected",false);
        $("#sucursal_ciudad option[value=0]").attr("selected",true);
    }


    
</script>
