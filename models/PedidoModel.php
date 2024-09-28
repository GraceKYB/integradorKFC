<?php

class PedidoModel {

    private $conexion;

    public function __construct() {
        require_once 'config/config.php';
        global $conexion;
        $this->conexion = $conexion;
    }
        // Método para listar pedidos
    public function listarPedidos() {
        $sql = "SELECT * FROM tbl_pedido";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para listar detalle de pedidos
    public function listarDetallePedidos() {
        $sql = "SELECT * FROM tbl_detalle_pedido";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
