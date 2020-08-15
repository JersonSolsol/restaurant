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
                    id_ciudad, id_usuario, negocio_nombre, negocio_direccion, negocio_coordenadas, negocio_ruc, negocio_telefono 
                    ) values(?,?,?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_ciudad,
                    $model->id_usuario,
                    $model->negocio_nombre,
                    $model->negocio_direccion,
                    $model->negocio_coordenadas,
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
                negocio_coordenadas = ?,
                negocio_ruc = ?,
                negocio_telefono = ?
                where id_negocio = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_ciudad,
                    $model->id_usuario,
                    $model->negocio_nombre,
                    $model->negocio_direccion,
                    $model->negocio_coordenadas,
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
                id_negocio, id_user, id_rol, negocio_user_datetime, negocio_user_estado
                ) values(?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_negocio,
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

}