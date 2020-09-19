<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 18/04/2019
 * Time: 21:00
 */

class Agente
{
    private $pdo;
    private $log;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    //Listar Toda La Info Sobre Agentes

    public function saveAgente($model){
        try {
            if(empty($model->id_agente)){
                $sql = 'insert into agente(
                    id_ciudad, id_user, agente_nombre, agente_direccion, agente_telefono, agente_estado
                    ) values(?,?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_ciudad,
                    $model->id_user,
                    $model->agente_nombre,
                    $model->agente_direccion,
                    $model->agente_telefono,
                    $model->agente_estado
                ]);

            } else {
                $sql = "update agente
                set
                id_ciudad = ?,
                id_user = ?,
                agente_nombre = ?,
                agente_direccion = ?,
                agente_telefono = ?
                where id_agente = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_ciudad,
                    $model->id_user,
                    $model->agente_nombre,
                    $model->agente_direccion,
                    $model->agente_telefono,
                    $model->id_agente
                ]);
                unset($_POST['id_agente']);
            }
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }


    public function listarAgente(){
        try{
            $sql = 'select * from agente';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listarTodo($id){
        try{
            $sql = 'select * from agente a INNER JOIN ciudad c ON a.id_ciudad = c.id_ciudad where id_agente = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function deleteAgente($id){
        try{
            $sql = 'delete from agente where id_agente = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }


















}