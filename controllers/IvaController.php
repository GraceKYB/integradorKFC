<?php
require_once 'models/IvaModel.php';
require_once 'config/config.php';

class IvaController {

    private $model;

    public function __construct() {
        $this->model = new IvaModel();
    }

    public function index() {
        $ivas = $this->model->listar();
        require_once 'views/iva/listar.php';
    }

    public function ver($id) {
        $iva = $this->model->obtenerPorId($id);
        require_once 'views/iva/ver.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $iva_porcentaje = $_POST['iva_porcentaje'];
            $iva_descripcion = $_POST['iva_descripcion'];

            // Llamar al modelo para crear el IVA
            $this->model->crear($iva_porcentaje, $iva_descripcion);

            header('Location: index.php?controller=Iva&action=index');
            exit();
        } else {
            // Mostrar la vista de crear IVA
            require_once 'views/iva/crear.php';
        }
    }

    public function editar() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $iva_porcentaje = $_POST['iva_porcentaje'];
            $iva_descripcion = $_POST['iva_descripcion'];

            // Llamar al modelo para editar el IVA
            $this->model->editar($id, $iva_porcentaje, $iva_descripcion);

            header("Location: index.php?controller=Iva&action=index");
            exit();
        } else {
            if ($id) {
                $iva = $this->model->obtenerPorId($id);
                require_once 'views/iva/editar.php';
            } else {
                echo "ID de IVA no proporcionado.";
            }
        }
    }

    public function eliminar() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
    
        if ($id) {
            $this->model->eliminar($id);
            header("Location: index.php?controller=Iva&action=index");
            exit();
        } else {
            echo "ID de IVA no proporcionado.";
        }
    }
}
?>
