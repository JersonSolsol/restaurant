<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 18/04/2019
 * Time: 20:37
 */

require 'app/models/Negocio.php';
require 'app/models/Ciudad.php';
class NegocioController{
    private $log;
    private $turn;
    private $menu;
    private $crypt;
    private $nav;

    public function __construct()
    {
        $this->log = new Log();
        $this->negocio = new Negocio();
        $this->ciudad = new Ciudad();
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

    //Funciones
    public function save(){
        try{
            $model = new Negocio();
            if(isset($_SESSION['id_negocio'])){
                $model->id_usuario = $this->crypt->decrypt($_SESSION['id_user'], _PASS_);
                $model->id_negocio = $_SESSION['id_negocio'];
                $model->id_ciudad = $_POST['negocio_ciudad'];
                $model->negocio_nombre= $_POST['negocio_nombre'];
                $model->negocio_direccion = $_POST['negocio_direccion'];
                $model->negocio_coordenadas = $_POST['negocio_coordenadas'];
                $model->negocio_ruc = $_POST['negocio_ruc'];
                $model->negocio_telefono = $_POST['negocio_telefono'];
                $result = $this->negocio->save($model);

                
            } else {
                $model->id_usuario = $this->crypt->decrypt($_SESSION['id_user'], _PASS_);
                $model->id_ciudad = $_POST['negocio_ciudad'];
                $model->negocio_nombre= $_POST['negocio_nombre'];
                $model->negocio_direccion = $_POST['negocio_direccion'];
                $model->negocio_coordenadas = $_POST['negocio_coordenadas'];
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
}   


