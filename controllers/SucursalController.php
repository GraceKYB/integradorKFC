<?php
require_once 'models/SucursalModel.php';
require_once 'config/config.php';

class SucursalController {

    private $model;

    public function __construct() {
        $this->model = new SucursalModel();
    }

    public function index() {
        $sucursales = $this->model->listar();
        require_once 'views/sucursales/listar.php';
    }

    public function ver($id) {
        $sucursal = $this->model->obtenerPorId($id);
        require_once 'views/sucursales/ver.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['suc_nombre'];
            $direccion = $_POST['suc_direccion'];

            $this->model->crear($nombre, $direccion);

            header('Location: index.php?controller=Sucursal&action=index');
            exit();
        } else {
            require_once 'views/sucursales/crear.php';
        }
    }

    public function editar() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['suc_nombre'];
            $direccion = $_POST['suc_direccion'];

            $this->model->editar($id, $nombre, $direccion);

            header("Location: index.php?controller=Sucursal&action=index");
            exit();
        } else {
            if ($id) {
                $sucursal = $this->model->obtenerPorId($id);
                require_once 'views/sucursales/editar.php';
            } else {
                echo "ID de sucursal no proporcionado.";
            }
        }
    }

    public function eliminar() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($id) {
            $this->model->eliminar($id);
            header("Location: index.php?controller=Sucursal&action=index");
            exit();
        } else {
            echo "ID de sucursal no proporcionado.";
        }
    }
}
?>
