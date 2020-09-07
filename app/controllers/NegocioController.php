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
class NegocioController{
    private $log;
    private $turn;
    private $menu;
    private $negocio;
    private $ciudad;
    private $rol;
    private $negocio_user;
    private $sucursal;
    private $mesas;
    private $list_sucursal;
    private $usuario;
    private $crypt;
    private $nav;

    public function __construct()
    {
        $this->log = new Log();
        $this->negocio = new Negocio();
        $this->ciudad = new Ciudad();
        $this->usuario = new User();
        $this->rol = new Role();
        $this->negocio_user = new Negocio();
        $this->sucursal = new Negocio();
        $this->mesas = new Negocio();
        $this->list_sucursal = new Negocio();
        $this->crypt = new Crypt();
    }

    //Vistas
    public function all(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $negocio = $this->negocio->listAll();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'negocio/all.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function add(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $listaciudad = $this->ciudad->listciudad();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'negocio/add.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (\Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function edit(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            $_SESSION['id_negocio'] = $id;
            $negocio = $this->negocio->list($id);
            $listaciudad = $this->ciudad->listciudad();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'negocio/edit.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (\Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function gestionar(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            $_SESSION['id_gestionar'] = $id;
            $negocio = $this->negocio->listgestionar($id);
            $usuario = $this->usuario->listarUsuario();
            $negocio_user = $this->negocio->listRoleUser($id);
            $list_sucursal = $this->negocio->listarSucursalporNegocio($id);
            $rol = $this->rol->listarRol();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'negocio/gestionar.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (\Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function misnegocios(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $usern = $this->crypt->decrypt($_SESSION['id_user'], _PASS_);
            $mostrarnegocioUser = $this->negocio->listUserNegocios($usern);
            $negocio = $this->negocio->listAll();

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'negocio/misnegocios.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function sucursal(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            //$_SESSION['id_sucursal'] = $id;
            $negocio = $this->negocio->listgestionar($id);
            $usuario = $this->usuario->listarUsuario();
            $sucursal = $this->negocio->listSucursal($id);
            $listciudad = $this->ciudad->listciudad();
            $rol = $this->rol->listarRol();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'negocio/sucursal.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (\Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function mesas(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            //$_SESSION['id_mesa'] = $id;
            $negocio = $this->negocio->listgestionar($id);
            $usuario = $this->usuario->listarUsuario();
            $sucursal = $this->negocio->listSucursalMesa($id);
            $mesas = $this->negocio->listMesa();

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'negocio/mesas.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (\Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    //Funciones
    public function save(){
        try{
            $model = new Negocio();

            if(isset($_SESSION['id_negocio'])) {
                $validacion = $this->negocio->validarNameeditar($_POST['negocio_nombre'], $_SESSION['id_negocio']);
                $model->id_negocio = $_SESSION['id_negocio'];
            } else {
                $validacion = $this->negocio->validarName($_POST['negocio_nombre']);

            } if($validacion){
                $result = 3;
            }else {
                $model->id_usuario = $this->crypt->decrypt($_SESSION['id_user'], _PASS_);
                $model->id_ciudad = $_POST['negocio_ciudad'];
                $model->negocio_nombre= $_POST['negocio_nombre'];
                $model->negocio_direccion = $_POST['negocio_direccion'];
                $model->negocio_coordenadas_X = $_POST['negocio_coordenadas_X'];
                $model->negocio_coordenadas_Y = $_POST['negocio_coordenadas_Y'];
                $model->negocio_ruc = $_POST['negocio_ruc'];
                $model->negocio_telefono = $_POST['negocio_telefono'];     
                $result = $this->negocio->save($model);

            }
          } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function delete(){
        try{
            $id_negocio = $_POST['id'];
            $result = $this->negocio->delete($id_negocio);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function deleteUser(){
        try{
            $id_negocio_user = $_POST['id_negocio_user'];
            $result = $this->negocio->deleteUser($id_negocio_user);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }



    public function saveRoleUser(){
        try{
            $model = new Negocio();

            $validaruser = $this->negocio->validarUserRol($_POST['sucursal'], $_POST['user']);
            if ($validaruser){
                $result = 3;
            } else{
                $model->id_sucursal = $_POST['sucursal'];
                $model->id_user= $_POST['user'];
                $model->id_rol = $_POST['role'];
                $model->negocio_user_datetime = date('Y-m-d H:i:s');
                $model->negocio_user_estado = 1;
                $result = $this->negocio->saveRoleUser($model);
            }

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }






    public function saveSucursal(){
        try{
            $model = new Negocio();

            if(isset($_SESSION['id_sucursal'])) {
                $validar_sucursal = $this->negocio->validarSucursalEditar($_POST['sucursal_nombre'],$_POST['id_sucursal'],$_POST['$id']);
                $model->id_sucursal = $_POST['id_sucursal'];
            } else{
                $validar_sucursal = $this->negocio->validarSucursal($_POST['sucursal_nombre'], $_POST['id']);
            } if($validar_sucursal){
                $result = 3;
            } else {
                $model->id_usuario = $this->crypt->decrypt($_SESSION['id_user'], _PASS_);
                $model->sucursal_nombre = $_POST['sucursal_nombre'];
                $model->sucursal_direccion = $_POST['sucursal_direccion'];
                $model->id_ciudad = $_POST['sucursal_ciudad'];
                $model->sucursal_coordenadas_X = $_POST['sucursal_coordenadas_X'];
                $model->sucursal_coordenadas_Y = $_POST['sucursal_coordenadas_Y'];
                $model->sucursal_ruc = $_POST['sucursal_ruc'];
                $model->sucursal_telefono = $_POST['sucursal_telefono'];
                $model->id_negocio = $_POST['id'];
                $model->id_sucursal = $_POST['id_sucursal'];
                $result = $this->negocio->saveSucursal($model);
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }


    public function deleteSucursal(){
        try{
            $id_sucursal = $_POST['id_sucursal'];
            $result = $this->negocio->deleteSucursal($id_sucursal);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;

}

    public function saveMesas(){
        try{
            $model = new Negocio();

            if(!empty($_POST['id_mesa'])) {
                $model->id_mesa = $_POST['id_mesa'];
            }
            $model->id_sucursal = $_POST['id_sucursal'];
            $model->mesa_nombre = $_POST['mesa_nombre'];
            $model->mesa_user_datetime = date('Y-m-d H:i:s');
            $model->mesa_user_estado = 1;
            $model->id_mesa = $_POST['id_mesa'];
            $result = $this->negocio->saveMesas($model);

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function deleteMesa(){
        try{
            $id_mesa = $_POST['id_mesa'];
            $result = $this->negocio->deleteMesa($id_mesa);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function cambiarEstado(){
        try {
            $id_mesa = $_POST['id'];
            $mesa_estado = $_POST['mesa_estado'];
            $result = $this->negocio->cambiarEstado($id_mesa,$mesa_estado);

        }catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;

        }
        echo $result;
    }


}   


