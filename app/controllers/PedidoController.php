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

    public function __construct()
    {
        $this->log = new Log();
        $this->negocio = new Negocio();
        $this->ciudad = new Ciudad();
        $this->usuario = new User();
        $this->rol = new Role();
        $this->crypt = new Crypt();
        $this->pedido = new Pedido();
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
    public function tabla_productos(){
        require _VIEW_PATH_ . 'pedido/tabla_productos.php';
    }


    //Funciones

    public function search_by_producto(){
        try{
            if(isset($_POST['select_pedidos'])){
                $product = $this->pedido->search_by_producto($_POST['select_pedidos']);
                $result = $product;
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
                    array_push($_SESSION['pedidos'], [$_POST['nombre'], $_POST['cantidad'], round($_POST['precio'], 2), $_POST['product_totalb']]);
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
            $client = $this->client->listClientbyNumber($_POST['client_number']);

            $id_client = $client->id_client;
            $id_turn = $this->active->getTurnactive();
            $id_user = $this->crypt->decrypt($_SESSION['id_user'],_PASS_);

            $saleproduct_type = $_POST['saleproduct_type'];
            $saleproduct_correlative = 1;
            $correlative = $this->correlative->list();
            if($saleproduct_type == "BOLETA"){
                $saleproduct_correlative = "BN° " . $correlative->correlative_b;
            } else {
                $saleproduct_correlative = "FN° " . $correlative->correlative_f;
            }
            $saleproduct_total = $_POST['saleproduct_total'];
            $saleproduct_date = date("Y-m-d H:i:s");
            $saleproduct_cancelled = 1;

            $savesale = $this->sell->insertSale($id_client, $id_user, $id_turn, $saleproduct_type, $saleproduct_correlative, $saleproduct_total, $saleproduct_date, $saleproduct_cancelled);
            $idsale = $savesale->id_saleproduct;

            if($idsale != 2){
                foreach ($_SESSION['productos'] as $p){
                    $subtotal = round($p[3] * $p[4], 2);
                    $id_saleproduct = $savesale->id_saleproduct;
                    $id_productforsale = $p[0];
                    $sale_productname = $p[1];
                    $sale_unid = $p[2];
                    $sale_price= $p[3];
                    $sale_productscant = $p[4];
                    $sale_productstotalselled = $p[2] * $p[4];
                    $sale_productstotalprice = $subtotal;
                    $savedetail = $this->sell->insertSaledetail($id_saleproduct, $id_productforsale, $sale_productname, $sale_unid, $sale_price, $sale_productscant, $sale_productstotalselled, $sale_productstotalprice);
                    if($savedetail == 1){
                        $reduce = $sale_unid * $sale_productscant;
                        $id_product = $this->inventory->listIdproducforproductsale($id_productforsale);
                        $this->sell->saveProductstock($reduce, $id_product);
                        $return = 1;
                    } else {
                        $return = 2;
                    }
                }
            } else {
                $return = 2;
            }

            if($return == 1){
                $return = $savesale->id_saleproduct;

                if($saleproduct_type == "BOLETA"){
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
}