<?php
require_once 'models/MargenGananciaModel.php';

class MargenGananciaController {

    private $model;

    public function __construct() {
        $this->model = new MargenGananciaModel();
    }

    public function index() {
        $margenes = $this->model->listar();
        require_once 'views/margenes/listar.php';
    }

    public function ver($id) {
        $margen = $this->model->obtenerPorId($id);
        require_once 'views/margenes/ver.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $porcentaje = $_POST['mg_porcentaje'];
            $descripcion = $_POST['mg_descripcion'];

            // Llamar al modelo para crear el margen de ganancia
            $this->model->crear($porcentaje, $descripcion);

            header('Location: index.php?controller=MargenGanancia&action=index');
            exit();
        } else {
            // Mostrar la vista de crear margen de ganancia
            require_once 'views/margenes/crear.php';
        }
    }
    
    public function editar() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $porcentaje = $_POST['mg_porcentaje'];
            $descripcion = $_POST['mg_descripcion'];

            // Llamar al modelo para editar el margen de ganancia
            $this->model->editar($id, $porcentaje, $descripcion);

            header("Location: index.php?controller=MargenGanancia&action=index");
            exit();
        } else {
            if ($id) {
                $margen = $this->model->obtenerPorId($id);
                require_once 'views/margenes/editar.php';
            } else {
                echo "ID de margen de ganancia no proporcionado.";
            }
        }
    }

    public function eliminar() {
        // Obtener el ID desde la URL
        $id = isset($_GET['id']) ? $_GET['id'] : null;
    
        if ($id) {
            $this->model->eliminar($id);
            // Redireccionar al listar márgenes para actualizar la vista
            header("Location: index.php?controller=MargenGanancia&action=index");
            exit();
        } else {
            echo "ID de margen de ganancia no proporcionado.";
        }
    }
}
?>
