<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 22/04/2019
 * Time: 12:26
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
                <center><h2>Lista de Pedidos Registrados</h2></center>
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-md-3">
                <label for="fecha_i">Desde:</label>
                <input type="date" class="form-control" id="fecha_i" value="<?php echo $fecha;?>">
            </div>
            <div class="col-md-3">
                <label for="fecha_f">Hasta:</label>
                <input type="date" class="form-control" id="fecha_f" value="<?php echo $fecha;?>">
            </div>
            <div class="col-xs-2">
                <div class="form-group">
                    <label class="col-form-label">Usuario:</label>
                    <select class="form-control" id= "usuario">
                        <option value="">Elegir Usuario</option>
                        <?php
                        foreach($usuario as $u){
                            ?>
                            <option value="<?php echo $u->id_user;?>"><?php echo $u->user_nickname ;?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="form-group">
                    <label class="col-form-label">Estado:</label>
                    <select class="form-control" id= "estado_pedido">
                        <option value="">Elegir Estado</option>
                        <option value="0">PENDIENTE</option>
                        <option value="1">PAGADO</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="col-xs-2">
                <a><button class="btn btn-success" onchange="search_pedido()"><i class="fa fa-search"></i> BUSCAR</button></a>
            </div>
            <div class="col-lg-12">
                <table id="" class="table table-bordered table-hover">
                    <thead class="text-capitalize">
                    <tr>
                        <th>N°</th>
                        <th>Fecha</th>
                        <th>COD</th>
                        <th>Usuario Vendedor</th>
                        <th>Cliente</th>
                        <th>DNI ó RUC</th>
                        <th>Total de Venta</th>
                        <th>Estado Venta</th>
                        <th>Detalles</th>
                    </tr>
                    </thead>
                    <tbody id="tabla_registro_pedidos">
                    <tr><td colspan="9">Seleccione un registro</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <form method="post" target="_blank" action="<?php echo _SERVER_;?>Pedido/kardex_por_producto_PDF">
                    <input type="hidden" name="fecha_i_f" id="fecha_i_f" value="">
                    <input type="hidden" name="fecha_f_f" id="fecha_f_f" value="">
                    <input type="hidden" name="id_user" id="id_user" value="">
                    <input type="hidden" name="estado_pedido_p" id="estado_pedido_p" value="">
        <center><a  href="<?php echo _SERVER_;?>/Pedido/pedidoPDF" target="_blank" class="btn btn-primary"><i class="fa fa-download"></i> Imprimir Reporte</a><a id="btnExportar" onclick="descargarExcel" target="_blank" class="btn btn-success"><i class="fa fa-download"></i> Generar Excel</a></center>

                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="col-xs-6">

                </div>
                <div class="col-xs-6">

                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>pedido.js"></script>


<script>
    $(function () {
        $("#example2").DataTable();
    });
    function search_pedido() {
        var fecha_i = $("#fecha_i").val();
        var fecha_f = $("#fecha_f").val();
        var usuario = $("#usuario").val();
        var estado_pedido = $("#estado_pedido").val();
        $("#fecha_i_f").val(fecha_i);
        $("#fecha_f_f").val(fecha_f);
        $("#id_user").val(usuario);
        $("#estado_pedido_p").val(estado_pedido);
        $.post("<?php echo _SERVER_;?>Pedido/search_pedido", { fecha_i: fecha_i,fecha_f: fecha_f, usuario:usuario, estado_pedido:estado_pedido}, function(data){
            $("#tabla_registro_pedidos").html(data);
        });
    }

</script>