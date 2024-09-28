<?php
require_once 'models/CategoriaModel.php';
require_once 'config/config.php';

class CategoriaController {

    private $model;

    public function __construct() {
        $this->model = new CategoriaModel();
    }

    public function index() {
        $categorias = $this->model->listar();
        require_once 'views/categorias/listar.php';
    }

    public function listar() {
        $sql = "SELECT * FROM tbl_categoria WHERE estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['cat_nombre'];

            // Procesar la imagen
            $imagen = $_FILES['cat_imagen'];
            $imagenBase64 = null;

            if ($imagen['error'] === 0) {
                // Verifica que el archivo sea una imagen
                $tipoImagen = mime_content_type($imagen['tmp_name']);
                if (strpos($tipoImagen, 'image/') === false) {
                    echo "El archivo seleccionado no es una imagen.";
                    return;
                }

                // Convertir la imagen a base64
                $imagenContenido = file_get_contents($imagen['tmp_name']);
                $imagenBase64 = base64_encode($imagenContenido);

                // Opcional: Guardar el tipo de imagen junto con los datos base64
                // $tipoImagenBase64 = $tipoImagen; // Ejemplo: 'image/jpeg'
            } else {
                echo "Error en la imagen.";
                return;
            }

            // Llamar al modelo para crear la categoría
            $this->model->crear($nombre, $imagenBase64);

            header('Location: index.php?controller=Categoria&action=index');
            exit();
        } else {
            // Mostrar la vista de crear categoría
            require_once 'views/categorias/crear.php';
        }
    }
    
    public function editar() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['cat_nombre'];

            // Procesar la imagen
            $imagen = $_FILES['cat_imagen'];
            $imagenBase64 = null;

            if ($imagen['error'] === 0) {
                // Verifica que el archivo sea una imagen
                $tipoImagen = mime_content_type($imagen['tmp_name']);
                if (strpos($tipoImagen, 'image/') === false) {
                    echo "El archivo seleccionado no es una imagen.";
                    return;
                }

                // Convertir la imagen a base64
                $imagenContenido = file_get_contents($imagen['tmp_name']);
                $imagenBase64 = base64_encode($imagenContenido);

                // Opcional: Se puede guardar el tipo de imagen junto con los datos base64 para su uso futuro
                // $tipoImagenBase64 = $tipoImagen; // Ejemplo: 'image/jpeg'
            } else {
                // Si no se selecciona una nueva imagen, mantener la actual
                $categoria = $this->model->obtenerPorId($id);
                $imagenBase64 = $categoria['cat_imagen'];
            }

            // Llamar al modelo para editar la categoría
            $this->model->editar($id, $nombre, $imagenBase64);

            header("Location: index.php?controller=Categoria&action=index");
            exit();
        } else {
            if ($id) {
                $categoria = $this->model->obtenerPorId($id);
                require_once 'views/categorias/editar.php';
            } else {
                echo "ID de categoría no proporcionado.";
            }
        }
    }

    public function eliminar() {
        // Obtener el ID desde la URL
        $id = isset($_GET['id']) ? $_GET['id'] : null;
    
        if ($id) {
            $this->model->eliminar($id);
            // Redireccionar al listar categorías para actualizar la vista
            header("Location: index.php?controller=Categoria&action=index");
            exit();
        } else {
            echo "ID de categoría no proporcionado.";
        }
    }
}

?>