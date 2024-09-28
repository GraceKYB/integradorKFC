<?php
require_once 'models/ProductoModel.php';
require_once 'config/config.php';

class ProductoController {

    private $model;

    public function __construct() {
        $this->model = new ProductoModel();
    }

    public function index() {
        $productos = $this->model->listar();
        require_once 'views/productos/listar.php';
    }

    public function ver($id) {
        $producto = $this->model->obtenerPorId($id);
        require_once 'views/productos/ver.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['prod_nombre'];
            $descripcion = $_POST['prod_descripcion'];
            $precio_compra = $_POST['prod_precio_compra'];
            $extra = isset($_POST['prod_extra']) ? 1 : 0;
            $stock = $_POST['prod_stock'];
            $iva_id = $_POST['iva_id'];
            $mg_id = $_POST['mg_id'];
            $suc_id = $_POST['suc_id'];

            // Procesar la imagen
            $imagen = $_FILES['prod_imagen'];
            $imagenBase64 = null;

            if ($imagen['error'] === 0) {
                // Verifica que el archivo sea una imagen
                $tipoImagen = mime_content_type($imagen['tmp_name']);
                if (strpos($tipoImagen, 'image/') === false) {
                    echo "El archivo seleccionado no es una imagen.";
                    return;
                }
                // Convierte la imagen en base64
                $imagenBase64 = base64_encode(file_get_contents($imagen['tmp_name']));
            }

            $this->model->crear($nombre, $descripcion, $precio_compra, $extra, $stock, $iva_id, $mg_id, $suc_id, $imagenBase64);
            header('Location: index.php?controller=producto&action=index');
        } else {
            $ivas = $this->model->obtenerIvas();
            $margen_ganancias = $this->model->obtenerMargenGanancias();
            $sucursales = $this->model->obtenerSucursales();
            require_once 'views/productos/crear.php';
        }
    }

    public function editar() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['prod_nombre'];
            $descripcion = $_POST['prod_descripcion'];
            $precio_compra = $_POST['prod_precio_compra'];
            $extra = isset($_POST['prod_extra']) ? 1 : 0;
            $stock = $_POST['prod_stock'];
            $iva_id = $_POST['iva_id'];
            $mg_id = $_POST['mg_id'];
            $suc_id = $_POST['suc_id'];

            // Procesar la imagen
            $imagen = $_FILES['prod_imagen'];
            $imagenBase64 = null;

            if ($imagen['error'] === 0) {
                // Verifica que el archivo sea una imagen
                $tipoImagen = mime_content_type($imagen['tmp_name']);
                if (strpos($tipoImagen, 'image/') === false) {
                    echo "El archivo seleccionado no es una imagen.";
                    return;
                }
                // Convierte la imagen en base64
                $imagenBase64 = base64_encode(file_get_contents($imagen['tmp_name']));
            }

            $this->model->editar($id, $nombre, $descripcion, $precio_compra, $extra, $stock, $iva_id, $mg_id, $suc_id, $imagenBase64);
            header('Location: index.php?controller=producto&action=index');
        } else {
            $producto = $this->model->obtenerPorId($id);
            $ivas = $this->model->obtenerIvas();
            $margen_ganancias = $this->model->obtenerMargenGanancias();
            $sucursales = $this->model->obtenerSucursales();
            require_once 'views/productos/editar.php';
        }
    }

    public function eliminar() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $this->model->eliminar($id);
        header('Location: index.php?controller=producto&action=index');
    }
}

?>
