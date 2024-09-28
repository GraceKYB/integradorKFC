<?php
require_once 'models/MetodoPagoModel.php';

class MetodoPagoController {

    private $model;

    public function __construct() {
        $this->model = new MetodoPagoModel();
    }

    public function index() {
        $metodosPago = $this->model->listar();
        require_once 'views/metodo/listar.php';
    }

    public function ver($id) {
        $metodoPago = $this->model->obtenerPorId($id);
        require_once 'views/metodo/ver.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['mp_nombre'];

            $this->model->crear($nombre);

            header('Location: index.php?controller=MetodoPago&action=index');
            exit();
        } else {
            require_once 'views/metodo/crear.php';
        }
    }

    public function editar() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['mp_nombre'];

            $this->model->editar($id, $nombre);

            header("Location: index.php?controller=MetodoPago&action=index");
            exit();
        } else {
            if ($id) {
                $metodoPago = $this->model->obtenerPorId($id);
                require_once 'views/metodo/editar.php';
            } else {
                echo "ID de método de pago no proporcionado.";
            }
        }
    }

    public function eliminar() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($id) {
            $this->model->eliminar($id);
            header("Location: index.php?controller=MetodoPago&action=index");
            exit();
        } else {
            echo "ID de método de pago no proporcionado.";
        }
    }
}
?>
