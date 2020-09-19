<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 18/04/2019
 * Time: 20:37
 */

require 'app/models/Negocio.php';
require 'app/models/Ciudad.php';
require 'app/models/User.php';
require 'app/models/Role.php';
require 'app/models/Pedido.php';
require 'app/models/Sell.php';
require 'app/models/Client.php';
require 'app/models/Correlative.php';
require 'app/models/Active.php';
require 'app/models/Inventory.php';

class PedidoController{
    private $log;
    private $turn;
    private $menu;
    private $negocio;
    private $ciudad;
    private $rol;
    private $usuario;
    private $crypt;
    private $nav;
    private $pedido;
    private $client;
    private $active;
    private $correlative;
    private $sell;
    private $inventory;

    public function __construct()
    {
        $this->log = new Log();
        $this->negocio = new Negocio();
        $this->ciudad = new Ciudad();
        $this->usuario = new User();
        $this->rol = new Role();
        $this->crypt = new Crypt();
        $this->pedido = new Pedido();
        $this->client = new Client();
        $this->active = new Active();
        $this->correlative = new Correlative();
        $this->sell = new Sell();
        $this->inventory = new Inventory();

    }

    public function pedido(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $usern = $this->crypt->decrypt($_SESSION['id_user'], _PASS_);
            $mostrarsucursal = $this->negocio->listUserNegocios($usern);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'pedido/seleccionar_sucursal.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function seleccionar_mesa(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            //$_SESSION['id_mesa'] = $id;
            $usern = $this->crypt->decrypt($_SESSION['id_user'], _PASS_);
            $listsucursal = $this->pedido->listSucursal($id);
            $negocio = $this->pedido->listAllNegocio();
            $mesa = $this->pedido->listarMesa($id);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'pedido/seleccionar_mesa.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }


    public function realizar_pedido(){
        try{
            $_SESSION['pedidos'] = array();
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            //$_SESSION['id_mesa'] = $id;
            $usern = $this->crypt->decrypt($_SESSION['id_user'], _PASS_);
            $listarnegocios = $this->pedido->listarAllNegocios($id);
            $listarproductos = $this->pedido->listarProductos();
            $negocio = $this->pedido->listAllNegocio();
            $mesa = $this->pedido->listarMesa($id);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'pedido/realizar_pedido.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function viewhistoryPedido(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            //Cargamos Productos
            $salesP = $this->pedido->listSalesPedidos();

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'pedido/viewhistoryPedido.php';
            require _VIEW_PATH_ . 'footer.php';

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }

    }

    public function viewPedido(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            $pedido = $this->pedido->listarPedido($id);
            $pedidosale = $this->pedido->listPedidodetail($id);
            $cobrar = $this->pedido->listarCobro($id);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'pedido/viewpedido.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }

    }

    public function cobrarPedido(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            $pedido = $this->pedido->listarPedido($id);
            $pedidosale = $this->pedido->listPedidodetail($id);
            $clients = $this->client->listAll();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'pedido/cobrar_pedido.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }

    }

    public function editar_pedido(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            //$_SESSION['id_pedido'] = $id;
            $listarproductos = $this->pedido->listarProductos();
            $editpedido = $this->pedido->listarEditarPedidos($id);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'pedido/editar_pedido.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (\Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }


    public function tabla_productos(){
        $id = $_GET['id'] ?? 0;
        require _VIEW_PATH_ . 'pedido/tabla_productos.php';
    }

    public function tabla_productos2(){
        $id = $_GET['id'] ?? 0;
        require _VIEW_PATH_ . 'pedido/tabla_productos2.php';
    }


    //Funciones


    public function AgregarProducto(){
        try{
            if(isset($_POST['nombre']) && isset($_POST['cantidad']) && isset($_POST['precio']) && isset($_POST['product_totalb'])){
                $repeat = false;
                foreach($_SESSION['pedidos'] as $p){
                    if($_POST['nombre'] == $p[0]){
                        $repeat = true;
                    }
                }
                if(!$repeat){
                    array_push($_SESSION['pedidos'], [$_POST['id_productforsale'],$_POST['id_nombre'],$_POST['nombre'], $_POST['cantidad'], round($_POST['precio'], 2), $_POST['product_totalb']]);
                    $result = 1;
                } else {
                    $result = 3;
                }
            } else {
                $result = 2;
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;

    }


    public function PedidoProductos(){
        try{
            //Busca si hay un turno activo

            $id_mesa = $_POST['id'];
            $id_client = 1;
            $id_user = $this->crypt->decrypt($_SESSION['id_user'],_PASS_);
            $id_turn = $this->active->getTurnactive();

            $pedido_tipo = "BOLETA";
            $pedido_correlativo = 1;
            $correlative = $this->correlative->list();
            if($pedido_tipo == "BOLETA"){
                $pedido_correlativo = "BN° " . $correlative->correlative_b;
            }
            $pedido_total = $_POST['pedido_total'];
            $pedido_datetime = date("Y-m-d H:i:s");
            $pedido_cancelar = 0;

            $savesale = $this->pedido->insertSalePedido($id_mesa, $id_client, $id_user, $id_turn, $pedido_tipo, $pedido_correlativo, $pedido_total, $pedido_datetime, $pedido_cancelar);
            $idsale = $savesale->id_pedido;

            if($idsale != 2){
                foreach ($_SESSION['pedidos'] as $p){
                    $subtotal = round($p[3] * $p[4], 2);
                    $id_pedido = $savesale->id_pedido;
                    $id_productforsale = $p[0];
                    $detalle_nombre_producto = $p[2];
                    $detalle_unidad = $p[3];
                    $detalle_precio= $p[4];
                    $detalle_producto_cantidad = $p[3];
                    $detalle_producto_totalselled = $p[3] * $p[4];
                    $detalle_producto_totalprice = $subtotal;
                    $savedetail = $this->pedido->insertSaledetailPedido($id_pedido, $id_productforsale, $detalle_nombre_producto, $detalle_unidad, $detalle_precio, $detalle_producto_cantidad, $detalle_producto_totalselled, $detalle_producto_totalprice);

                    $return = 1;
                }
            } else {
                $return = 2;
            }

            if($return == 1){
                $return = $savesale->id_pedido;

                if($pedido_tipo == "BOLETA"){
                    $this->correlative->updatecorrelativeb();
                } else {
                    $this->correlative->updatecorrelativef();
                }
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $return = 2;
        }
        echo $return;
    }

    public function save_ventaPedido(){
        try{
            $id_pedido = $_POST['id'];
            $id_user = $this->crypt->decrypt($_SESSION['id_user'],_PASS_);

            $ventas_comprobante = $_POST['ventas_comprobante'];
            $ventas_metodopago = $_POST['ventas_metodopago'];
            $ventas_monto = $_POST['ventas_monto'];
            $ventas_datetime = date("Y-m-d H:i:s");
            $ventas_estado = 1;
            $pedido_cancelar = 1;
            $id_client = $_POST['id_client'];
            if($id_client != 1){
                //actualizar cliente en tabla pedido
                $actualizar = $this->pedido->actualizarClientePedido($id_client, $id_pedido);


            }
            $actualizar_estado = $this->pedido->actualizar_estadoPedido($id_pedido, $pedido_cancelar);
            $savepedido = $this->pedido->insertVenta($id_pedido, $id_user, $ventas_comprobante, $ventas_metodopago, $ventas_monto, $ventas_datetime, $ventas_estado);


            $return = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $return = 2;
        }
        echo $return;
    }

    //echo json_decode($return); --> Sirve para hacer los web-services


    public function search_by_producto(){
        try{
            if(isset($_POST['select_pedidos'])){
                $producto = $this->pedido->search_by_producto($_POST['select_pedidos']);
                $result = $producto;
                if(empty($result)){
                    $result = 2;
                } else {
                    $result = $result->product_name . '|' . $result->product_unid_type . '|' . $result->product_stock . '|' . $result->id_productforsale . '|' . $result->product_unid . '|' . $result->product_price;
                }
            } else {
                $result = 2;
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function deletePedido(){
        try{
            if(isset($_POST['id_nombre'])){
                $buscar = $_POST['id_nombre'];
                $totalar = count($_SESSION['pedidos']);
                for($i=0; $i < $totalar; $i++){
                    if($_SESSION['pedidos'][$i][1] == $buscar){
                        unset($_SESSION['pedidos'][$i]);
                    }
                }
                $_SESSION['pedidos'] = array_values($_SESSION['pedidos']);
                $result = 1;
            } else {
                $result = 2;
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function revokeSalePedido(){
        try{
            if(isset($_POST['id_pedido'])){
                $id_pedido = $_POST['id_pedido'];
                $revoke = $this->sell->revokeSale($id_pedido);
                if($revoke == 1){
                    $productos = $this->pedido->listPedidodetail($id_pedido);
                    foreach ($productos as $p){
                        $id = $this->inventory->getIdProductIdForProductSale($p->id_productforsale);
                        $turn = $this->active->getTurnactive();

                        $this->inventory->saveProductstock($id, $turn);
                    }
                    $result = 1;
                } else {
                    $result = 2;
                }

            } else {
                $result = 2;
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }


    public function deletePedidoA(){
        try{
            $id_pedido_detalle = $_POST['id_pedido_detalle'];
            $result = $this->pedido->deletePedido($id_pedido_detalle);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }


    public function savePedidoEdit(){
        try{
            $model = new Pedido();

            if($_POST['id_pedido_detalle'] == "") {
                $model->id_pedido_detalle = $_POST['id_pedido_detalle'];
            }
                $model->id_productforsale = $_POST['id_productforsale'];
                $model->detalle_nombre_producto = $_POST['detalle_nombre_producto'];
                $model->detalle_unidad = $_POST['detalle_unidad'];
                $model->detalle_precio = $_POST['detalle_precio'];
                $model->detalle_producto_cantidad = $_POST['detalle_unidad'];
                $model->detalle_producto_totalselled = $_POST['detalle_producto_totalprice'];
                $model->detalle_producto_totalprice = $_POST['detalle_producto_totalprice'];
                $model->id_pedido = $_POST['id'];
                $model->id_pedido_detalle = $_POST['id_pedido_detalle'];
                $result = $this->pedido->savePedidoEdit($model);

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }


}