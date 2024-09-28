<?php
require_once 'models/RolModel.php';
require_once 'config/config.php';

class RolController {

    private $model;

    public function __construct() {
        $this->model = new RolModel();
    }

    public function index() {
        $roles = $this->model->listar();
        require_once 'views/roles/listar.php';
    }

    public function ver($id) {
        $rol = $this->model->obtenerPorId($id);
        require_once 'views/roles/ver.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['rol_nombre'];

            // Llamar al modelo para crear el rol
            $this->model->crear($nombre);

            header('Location: index.php?controller=Rol&action=index');
            exit();
        } else {
            // Mostrar la vista de crear rol
            require_once 'views/roles/crear.php';
        }
    }
    
    public function editar() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['rol_nombre'];

            // Llamar al modelo para editar el rol
            $this->model->editar($id, $nombre);

            header("Location: index.php?controller=Rol&action=index");
            exit();
        } else {
            if ($id) {
                $rol = $this->model->obtenerPorId($id);
                require_once 'views/roles/editar.php';
            } else {
                echo "ID de rol no proporcionado.";
            }
        }
    }

    public function eliminar() {
        // Obtener el ID desde la URL
        $id = isset($_GET['id']) ? $_GET['id'] : null;
    
        if ($id) {
            $this->model->eliminar($id);
            // Redireccionar al listar roles para actualizar la vista
            header("Location: index.php?controller=Rol&action=index");
            exit();
        } else {
            echo "ID de rol no proporcionado.";
        }
    }
}
?>
