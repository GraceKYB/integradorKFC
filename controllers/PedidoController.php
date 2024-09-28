<?php
require_once 'models/PedidoModel.php';

class PedidoController {
    private $model;

    public function __construct() {
        $this->model = new PedidoModel();
    }

    // Método para listar ambos pedidos y detalle de pedidos
    public function index() {
        $pedidos = $this->model->listarPedidos();
        $detallePedidos = $this->model->listarDetallePedidos();
        require 'views/pedidos/listar.php'; // Vista para mostrar ambos listados
    }
}
?>
