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
            <div class="col-lg-8">
                <table id="example3" class="table table-bordered table-hover">
                    <thead class="text-capitalize">
                    <tr>
                        <th>Nombre del Negocio</th>
                        <th>Usuario</th>
                        <th>Rol</th>            
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($products as $product){
                        ?>
                        <tr>
                            <td>BUFEO TEC</td>
                            <td>JERSON </td>
                            <td>admin</td>
                            <!--<td><?php echo $product->product_name;?></td>
                            <td><?php echo $product->categoryp_name;?></td>
                            <td><?php echo $product->product_barcode;?></td> -->
                            
                            <!--<td><a class="btn btn-chico btn-warning btn-xs" type="button" href="<?php echo _SERVER_;?>Inventory/editProduct/<?php echo $product->id_product;?>"><i class="fa fa-pencil"></i> Editar</a><a class="btn btn-chico btn-danger btn-xs" onclick="preguntarSiNo(<?php echo $product->id_product;?>)"><i class="fa fa-times"></i> Eliminar</a><a class="btn btn-info btn-xs" href="<?php echo _SERVER_;?>Inventory/addProductstock/<?php echo $product->id_product;?>"><i class="fa fa-sort-numeric-asc"></i> Agregar Stock</a><a class="btn btn-primary btn-xs" href="<?php echo _SERVER_;?>Inventory/outProductstock/<?php echo $product->id_product;?>"><i class="fa fa-eraser"></i>Salida Stock</a>
                            </td>-->
                        </tr>
                        <!--<a class="btn btn-dropbox btn-xs" href="<?php echo _SERVER_;?>Inventory/productForsale/<?php echo $product->id_product;?>"><i class="fa fa-money"></i>  Ver Costo Venta</a>-->
                        <?php
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
