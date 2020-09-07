<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 18/04/2019
 * Time: 21:00
 */

class Pedido{
    private $pdo;
    private $log;
    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    public function listarSucursal($id)
    {
        try {
            $sql = 'select * from pedido p INNER JOIN mesas m ON p.id_mesa = m.id_mesa INNER JOIN user u ON p.id_user = u.id_user INNER JOIN sucursal s ON m.id_sucursal = s.id_sucursal where s.id_sucursal = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetchAll();

        } catch (Exception $e) {
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function listSucursal($id)
    {
        try {
            $sql = 'select * from sucursal s INNER JOIN negocio n ON s.id_negocio = n.id_negocio where s.id_sucursal = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();

        } catch (Exception $e) {
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function listAllNegocio(){
        try{
            $sql = 'select * from negocio';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetch();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listarMesa($id){
        try {
            $sql = 'select * from mesas m INNER JOIN sucursal s ON m.id_sucursal = s.id_sucursal where m.id_sucursal = ? and m.mesa_estado = 1 ';
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

    public function listarAllNegocios ($id){
        try{
            $sql = 'select * from mesas m INNER JOIN sucursal s ON m.id_sucursal = s.id_sucursal INNER JOIN negocio n ON s.id_negocio = n.id_negocio where m.id_mesa = ? limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listarProductos (){
        try{
            $sql = 'select * from productforsale pf INNER JOIN product p ON pf.id_product = p.id_product';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function search_by_producto($select_pedidos){
        try {
            $sql = 'select * from product p inner join productforsale p2 on p.id_product = p2.id_product where p.id_product = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$select_pedidos]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function savePedido($model){
        try {
                $sql = 'insert into pedido_detalle(
                id_pedido, id_productforsale, detalle_nombre_producto, detalle_unidad, detalle_precio, detalle_producto_cantidad, detalle_producto_totalselled, detalle_producto_totalprice
                ) values(?,?,?,?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_pedido,
                    $model->id_prooductforsale,
                    $model->detalle_nombre_producto,
                    $model->detalle_unidad,
                    $model->detalle_precio,
                    $model->detalle_producto_cantidad,
                    $model->detalle_producto_totalselled,
                    $model->detalle_producto_totalprice
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