<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 18/04/2019
 * Time: 21:00
 */

class Pedido
{
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

    public function listAllNegocio()
    {
        try {
            $sql = 'select * from negocio';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetch();

        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listarMesa($id)
    {
        try {
            $sql = 'select * from mesas m INNER JOIN sucursal s ON m.id_sucursal = s.id_sucursal where m.id_sucursal = ? and m.mesa_estado = 1 ';
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

    public function listarAllNegocios($id)
    {
        try {
            $sql = 'select * from mesas m INNER JOIN sucursal s ON m.id_sucursal = s.id_sucursal INNER JOIN negocio n ON s.id_negocio = n.id_negocio where m.id_mesa = ? limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();

        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listarProductos()
    {
        try {
            $sql = 'select * from productforsale pf INNER JOIN product p ON pf.id_product = p.id_product';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();

        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function search_by_producto($select_pedidos)
    {
        try {
            $sql = 'select * from product p inner join productforsale p2 on p.id_product = p2.id_product where p2.id_productforsale = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$select_pedidos]);
            $result = $stm->fetch();
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function savePedido($model)
    {
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
        } catch (Exception $e) {
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function insertVenta($id_pedido, $id_user, $ventas_comprobante, $ventas_metodopago, $ventas_monto, $ventas_datetime, $ventas_estado)
    {
        try {
            $sql = 'insert into ventas(
                id_pedido, id_user, ventas_comprobante, ventas_metodopago, ventas_monto, ventas_datetime, ventas_estado
                ) values(?,?,?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_pedido,
                $id_user,
                $ventas_comprobante,
                $ventas_metodopago,
                $ventas_monto,
                $ventas_datetime,
                $ventas_estado
            ]);
            $result = 1;
        } catch (Exception $e) {
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function insertPedido($model)
    {
        try {
            $sql = 'insert into ventas(
                id_pedido, id_user, ventas_comprobante, ventas_metodopago, ventas_monto, ventas_datetime, ventas_estado
                ) values(?,?,?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->id_pedido,
                $model->id_user,
                $model->ventas_comprobante,
                $model->ventas_metodopago,
                $model->ventas_monto,
                $model->ventas_datetime,
                $model->ventas_estado
            ]);
            $result = 1;
        } catch (Exception $e) {
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function insertSalePedido($id_mesa, $id_client, $id_user, $id_turn, $pedido_tipo, $pedido_correlativo, $pedido_total, $pedido_datetime, $pedido_cancelar)
    {
        try {
            $date = date("Y-m-d H:i:s");
            $sql = 'insert into pedido(id_mesa, id_client, id_user, id_turn, pedido_tipo, pedido_correlativo, pedido_total, pedido_datetime, pedido_cancelar) values(?,?,?,?,?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_mesa,
                $id_client,
                $id_user,
                $id_turn,
                $pedido_tipo,
                $pedido_correlativo,
                $pedido_total,
                $pedido_datetime,
                $pedido_cancelar
            ]);

            $sql2 = 'select id_pedido from pedido where pedido_datetime = ? and id_client = ?';
            $stm2 = $this->pdo->prepare($sql2);
            $stm2->execute([$pedido_datetime, $id_client]);
            $result = $stm2->fetch();
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = 2;
        }

        return $result;
    }

    public function insertSaledetailPedido($id_pedido, $id_productforsale, $detalle_nombre_producto, $detalle_unidad, $detalle_precio, $detalle_producto_cantidad, $detalle_producto_totalselled, $detalle_producto_totalprice)
    {
        try {
            $sql = 'insert into pedido_detalle (id_pedido, id_productforsale, detalle_nombre_producto, detalle_unidad, detalle_precio, detalle_producto_cantidad, detalle_producto_totalselled, detalle_producto_totalprice) values(?,?,?,?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_pedido,
                $id_productforsale,
                $detalle_nombre_producto,
                $detalle_unidad,
                $detalle_precio,
                $detalle_producto_cantidad,
                $detalle_producto_totalselled,
                $detalle_producto_totalprice
            ]);
            $result = 1;
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = 0;
        }
        return $result;
    }

    public function listarPedido($id){
        try {
            $sql = 'select * from pedido p inner join client c on p.id_client = c.id_client inner join user u on p.id_user = u.id_user where p.id_pedido = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listPedidodetail($id){
        try {
            $sql = 'select * from pedido_detalle where id_pedido = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function revokeSalePedido($id){
        try {
            $sql = 'update pedido set pedido_cancelar = 0 where id_pedido = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function listSalesPedidos(){
        try {
            $sql = 'select * from pedido p inner join user u on p.id_user = u.id_user inner join client c on p.id_client = c.id_client';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listarCobro($id){
        try {
            $sql = 'select * from pedido where id_pedido = ? limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function actualizarClientePedido ($id_client, $id_pedido){
        try{
            $sql = 'update pedido set id_client = ? where id_pedido = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_client, $id_pedido]);

            $result = 1;
        }catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function actualizar_estadoPedido ($id_pedido, $pedido_cancelar){
        try{
            $sql = 'update pedido set pedido_cancelar = ? where id_pedido = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([ $pedido_cancelar, $id_pedido]);

            $result = 1;
        }catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }


    public function listarEditarPedidos($id){
        try{
            $sql = 'select * from pedido p INNER JOIN pedido_detalle pd ON p.id_pedido = pd.id_pedido where p.id_pedido = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetchAll();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function deletePedido($id_pedido_detalle){
        try{
            $sql = 'delete from pedido_detalle where id_pedido_detalle = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_pedido_detalle]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }


    public function savePedidoEdit ($model){
        try {
            if(empty($model->id_pedido_detalle)) {
                $sql = 'insert into pedido_detalle(
                id_pedido, id_productforsale, detalle_nombre_producto, detalle_unidad, detalle_precio, detalle_producto_cantidad, detalle_producto_totalselled, detalle_producto_totalprice) 
                values(?,?,?,?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_pedido,
                    $model->id_productforsale,
                    $model->detalle_nombre_producto,
                    $model->detalle_unidad,
                    $model->detalle_precio,
                    $model->detalle_producto_cantidad,
                    $model->detalle_producto_totalselled,
                    $model->detalle_producto_totalprice
                ]);
            }else {
                $sql = "update pedido_detalle
                set
                    id_pedido = ?,
                    id_productforsale = ?,
                    detalle_nombre_producto = ?,
                    detalle_unidad = ?,
                    detalle_precio = ?,
                    detalle_producto_cantidad = ?,
                    detalle_producto_totalselled = ?,
                    detalle_producto_totalprice = ?
                    where id_pedido_detalle = ?";
               
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_pedido,
                    $model->id_productforsale,
                    $model->detalle_nombre_producto,
                    $model->detalle_unidad,
                    $model->detalle_precio,
                    $model->detalle_producto_cantidad,
                    $model->detalle_producto_totalselled,
                    $model->detalle_producto_totalprice,
                    $model->id_pedido_detalle
                ]);
                unset($_POST['id_pedido_detalle']);
            }
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;


    }

}