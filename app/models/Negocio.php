<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 18/04/2019
 * Time: 21:00
 */

class Negocio{
    private $pdo;
    private $log;
    public function __construct(){
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    //Listar Toda La Info Sobre Personas
    public function listAll(){
        try{
            $sql = 'select * from negocio';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }


    //Listar Una Unica Persona por ID
    public function list($id){
        try{
            $sql = 'select * from negocio n INNER JOIN ciudad c ON n.id_ciudad = c.id_ciudad where id_negocio = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    //Listar Una Unica Persona por ID
    public function listClientbyNumber($number){
        try{
            $sql = 'select * from client where client_number = ? limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$number]);
            $result = $stm->fetch();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    //Guardar o Editar Informacion de Role
    public function save($model){
        try {
            if(empty($model->id_negocio)){
                $sql = 'insert into negocio(
                    id_ciudad, id_usuario, negocio_nombre, negocio_direccion, negocio_coordenadas_X, negocio_coordenadas_Y, negocio_ruc, negocio_telefono 
                    ) values(?,?,?,?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_ciudad,
                    $model->id_usuario,
                    $model->negocio_nombre,
                    $model->negocio_direccion,
                    $model->negocio_coordenadas_X,
                    $model->negocio_coordenadas_Y,
                    $model->negocio_ruc,
                    $model->negocio_telefono
                ]);

            } else {
                $sql = "update negocio
                set
                id_ciudad = ?,
                id_usuario = ?,
                negocio_nombre = ?,
                negocio_direccion = ?,
                negocio_coordenadas_X = ?,
                negocio_coordenadas_Y = ?,
                negocio_ruc = ?,
                negocio_telefono = ?
                where id_negocio = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_ciudad,
                    $model->id_usuario,
                    $model->negocio_nombre,
                    $model->negocio_direccion,
                    $model->negocio_coordenadas_X,
                    $model->negocio_coordenadas_Y,
                    $model->negocio_ruc,
                    $model->negocio_telefono,
                    $model->id_negocio
                ]);
                unset($_SESSION['id_negocio']);
            }
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    //Borrar un Registro
    public function delete($id){
        try{
            $sql = 'delete from negocio where id_negocio = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function listgestionar($id){
        try{
            $sql = 'select * from negocio where id_negocio = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function saveRoleUser($model){
        try {
                $sql = 'insert into negocio_user(
                id_sucursal, id_user, id_rol, negocio_user_datetime, negocio_user_estado
                ) values(?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_sucursal,
                    $model->id_user,
                    $model->id_rol,
                    $model->negocio_user_datetime,
                    $model->negocio_user_estado
                ]);
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function listRoleUser($id){
        try {
            $sql = 'select * from negocio_user n INNER JOIN user u ON n.id_user = u.id_user INNER JOIN role r ON n.id_rol = r.id_role INNER JOIN sucursal s ON n.id_sucursal = s.id_sucursal where s.id_negocio = ? '  ;
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetchAll();

        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function validarUserRol($id , $id_user){
       try {

           $sql = 'select * from negocio_user nu INNER JOIN sucursal s ON nu.id_sucursal = s.id_sucursal where s.id_sucursal = ? and nu.id_user = ?';
           $stm = $this->pdo->prepare($sql);
           $stm->execute([$id, $id_user]);
           $resultado = $stm->fetch();
           (isset($resultado->id_negocio_user)) ? $result = true : $result = false;

       }catch (Exception $e){
               $this->log->insert($e->getMessage(),get_class($this).'|'.__FUNCTION__);
               $result = [];
       }
       return $result;
    }


    public function validarName($negocio_nombre){
        try {

            $sql = 'select * from negocio where negocio_nombre = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$negocio_nombre]);
            $resultado = $stm->fetch();
            (isset($resultado->id_negocio)) ? $result = true : $result = false;

        }catch (Exception $e){
            $this->log->insert($e->getMessage(),get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function validarSucursal($sucursal_nombre, $id_negocio){
        try {

            $sql = 'select * from sucursal where sucursal_nombre = ? and id_negocio = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$sucursal_nombre, $id_negocio]);
            $resultado = $stm->fetch();
            (isset($resultado->id_negocio)) ? $result = true : $result = false;

        }catch (Exception $e){
            $this->log->insert($e->getMessage(),get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
//para validar un editar
    public function validarNameeditar($negocio_nombre, $id_negocio){
        try {

            $sql = 'select * from negocio where negocio_nombre = ? and id_negocio <> ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$negocio_nombre, $id_negocio]);
            $resultado = $stm->fetch();
            (isset($resultado->id_negocio)) ? $result = true : $result = false;

        }catch (Exception $e){
            $this->log->insert($e->getMessage(),get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function validarSucursalEditar($sucursal_nombre, $id_sucursal, $id_negocio){
        try {

            $sql = 'select * from sucursal where sucursal_nombre = ? and id_negocio = ? and id_sucursal <> ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$sucursal_nombre, $id_sucursal,$id_negocio]);
            $resultado = $stm->fetch();
            (isset($resultado->id_negocio)) ? $result = true : $result = false;

        }catch (Exception $e){
            $this->log->insert($e->getMessage(),get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }


    public function deleteUser($id_negocio_user){
        try{
            $sql = 'delete from negocio_user where id_negocio_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_negocio_user]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function deleteSucursal($id_sucursal){
        try{
            $sql = 'delete from sucursal where id_sucursal = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_sucursal]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }



    public function listUserNegocios($id){
        try {
        $sql = 'select * from negocio_user nu INNER JOIN user u ON nu.id_user = u.id_user INNER JOIN sucursal s ON nu.id_sucursal = s.id_sucursal INNER JOIN negocio n ON s.id_negocio = n.id_negocio INNER JOIN role r ON nu.id_rol = r.id_role where u.id_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetchAll();

        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }


    public function saveSucursal($model){
        try {
            if(empty($model->id_sucursal)){
                $sql = 'insert into sucursal(
                    id_ciudad, id_negocio, sucursal_nombre, sucursal_direccion, sucursal_coordenadas_X, sucursal_coordenadas_Y, sucursal_ruc, sucursal_telefono 
                    ) values(?,?,?,?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_ciudad,
                    $model->id_negocio,
                    $model->sucursal_nombre,
                    $model->sucursal_direccion,
                    $model->sucursal_coordenadas_X,
                    $model->sucursal_coordenadas_Y,
                    $model->sucursal_ruc,
                    $model->sucursal_telefono
                ]);

            } else {
                $sql = "update sucursal
                set
                id_ciudad = ?,
                id_negocio = ?,
                sucursal_nombre = ?,
                sucursal_direccion = ?,
                sucursal_coordenadas_X = ?,
                sucursal_coordenadas_Y = ?,
                sucursal_ruc = ?,
                sucursal_telefono = ?
                where id_sucursal = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_ciudad,
                    $model->id_negocio,
                    $model->sucursal_nombre,
                    $model->sucursal_direccion,
                    $model->sucursal_coordenadas_X,
                    $model->sucursal_coordenadas_Y,
                    $model->sucursal_ruc,
                    $model->sucursal_telefono,
                    $model->id_sucursal
                ]);
                unset($_SESSION['id_sucursal']);
            }
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }


    public function listSucursal($id){
        try {
            $sql = 'select * from sucursal s INNER JOIN negocio n ON s.id_negocio = n.id_negocio INNER JOIN ciudad c ON s.id_ciudad = c.id_ciudad where s.id_negocio = ? '  ;
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetchAll();

        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function listSucursalMesa($id){
        try {
            $sql = 'select * from sucursal s INNER JOIN negocio n ON s.id_negocio = n.id_negocio INNER JOIN ciudad c ON s.id_ciudad = c.id_ciudad where s.id_sucursal = ? '  ;
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();

        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }


    public function listarSucursalporNegocio($id_negocio){
        try {
            $sql = 'select * from sucursal where id_negocio = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_negocio]);
            $result = $stm->fetchAll();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }



    public function saveMesas($model){
        try {
            if(empty($model->id_mesa)) {
                $sql = 'insert into mesas(
                id_sucursal, mesa_nombre
                ) values(?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_sucursal,
                    $model->mesa_nombre
                ]);
            }else {
                $sql = "update mesas
                set
                mesa_nombre = ?
                where id_mesa = ?";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->mesa_nombre,
                    $model->id_mesa
                ]);
            }
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }


    public function listMesa(){
        try {
            $sql = 'select * from mesas ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([]);
            $result = $stm->fetchAll();

        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }



    public function deleteMesa($id_mesa){
        try{
            $sql = 'delete from mesas where id_mesa = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_mesa]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function  cambiarEstado($id_mesa,$mesa_estado){
        try {
            $sql = "update mesas set
                mesa_estado = ?
                where id_mesa = ?";

            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $mesa_estado, $id_mesa
            ]);
            $result = 1;
        }catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

}