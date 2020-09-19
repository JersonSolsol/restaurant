<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 18/04/2019
 * Time: 20:37
 */

require 'app/models/Ciudad.php';
require 'app/models/User.php';
require 'app/models/Role.php';
require 'app/models/Agente.php';
class AgenteController
{
    private $log;
    private $turn;
    private $menu;
    private $ciudad;
    private $rol;
    private $usuario;
    private $crypt;
    private $nav;
    private $agente;

    public function __construct()
    {
        $this->log = new Log();
        $this->ciudad = new Ciudad();
        $this->usuario = new User();
        $this->rol = new Role();
        $this->crypt = new Crypt();
        $this->agente = new Agente();
    }

    //VISTAS

    public function agregarAgente(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $listaciudad = $this->ciudad->listciudad();

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'agente/agregarAgente.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (\Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function listar(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $agente = $this->agente->listarAgente();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'agente/listar.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function editarAgente(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            $_SESSION['id_agente'] = $id;
            $agente = $this->agente->listarTodo($id);
            $listaciudad = $this->ciudad->listciudad();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'agente/editarAgente.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (\Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    //FUNCIONES


    public function saveAgente(){
        try{
            $model = new Agente();

            if(isset($_POST['id_agente'])) {
                $model->id_agente = $_POST['id_agente'];
            }
                $model->id_user = $this->crypt->decrypt($_SESSION['id_user'], _PASS_);
                $model->id_ciudad = $_POST['agente_ciudad'];
                $model->agente_nombre= $_POST['agente_nombre'];
                $model->agente_direccion = $_POST['agente_direccion'];
                $model->agente_telefono = $_POST['agente_telefono'];
                $model->id_agente = $_POST['id'];
                $model->agente_estado = 1 ;

                $result = $this->agente->saveAgente($model);

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function deleteAgente(){
        try{
            $id_agente = $_POST['id'];
            $result = $this->agente->deleteAgente($id_agente);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }





}