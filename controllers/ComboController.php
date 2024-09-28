<?php
require_once 'models/ComboModel.php';
require_once 'config/config.php';

class ComboController {

    private $model;

    public function __construct() {
        $this->model = new ComboModel();
    }

    public function index() {
        $combos = $this->model->listar();
        require_once 'views/combos/listar.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['com_nombre'];
            $cat_id = $_POST['cat_id'];
            
            // Procesar la imagen
            $imagen = $_FILES['com_imagen'];
            $imagenBase64 = null;
    
            if ($imagen['error'] === 0) {
                $tipoImagen = mime_content_type($imagen['tmp_name']);
                if (strpos($tipoImagen, 'image/') === false) {
                    echo "El archivo seleccionado no es una imagen.";
                    return;
                }
    
                $imagenContenido = file_get_contents($imagen['tmp_name']);
                $imagenBase64 = base64_encode($imagenContenido);
            } else {
                echo "Error en la imagen.";
                return;
            }
    
            // Obtener los productos seleccionados y calcular descripción y precio
            $prod_ids = $_POST['prod_id'];  // Array de IDs de productos seleccionados
            $dc_stock = $_POST['dc_stock']; // Stock para todos los productos seleccionados
    
            $descripcionCombo = "";
            $precioCombo = 0.0;
            $detalleCombos = [];
    
            foreach ($prod_ids as $prod_id) {
                // Obtener detalles del producto
                $producto = $this->model->obtenerProductoPorId($prod_id);
                $descripcionCombo .= $producto['prod_nombre'] . " " . $producto['prod_descripcion'] . ", ";
                $precioCombo += round($producto['prod_precio_venta'], 2);
                
                // Agregar al detalle del combo
                $detalleCombos[] = [
                    'prod_id' => $prod_id,
                    'dc_stock' => $dc_stock
                ];
            }
    
            // Quitar la última coma de la descripción generada
            $descripcionCombo = rtrim($descripcionCombo, ', ');
    
            // Crear el combo
            $this->model->crear($nombre, $descripcionCombo, $precioCombo, $imagenBase64, $cat_id, $detalleCombos);
            header('Location: index.php?controller=Combo&action=index');
            exit();
        } else {
            require_once 'models/ProductoModel.php';
            require_once 'models/CategoriaModel.php'; 
    
            $productoModel = new ProductoModel();
            $productos = $productoModel->listar();
    
            $categoriaModel = new CategoriaModel();
            $categorias = $categoriaModel->listar();
    
            require_once 'views/combos/crear.php';
        }
    }
    
    public function editar() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['com_nombre'];
            $cat_id = $_POST['cat_id'];
            $dc_stock = $_POST['dc_stock'];
    
            // Procesar la imagen
            $imagen = $_FILES['com_imagen'];
            $imagenBase64 = null;
    
            if ($imagen['error'] === 0) {
                $tipoImagen = mime_content_type($imagen['tmp_name']);
                if (strpos($tipoImagen, 'image/') === false) {
                    echo "El archivo seleccionado no es una imagen.";
                    return;
                }
    
                $imagenContenido = file_get_contents($imagen['tmp_name']);
                $imagenBase64 = base64_encode($imagenContenido);
            } else {
                // Verificar que se encontró el combo antes de acceder a sus elementos
                $combo = $this->model->obtenerPorId($id);
                if ($combo) {
                    $imagenBase64 = $combo['com_imagen'];
                } else {
                    echo "Combo no encontrado.";
                    return;
                }
            }
    
            // Obtener los productos seleccionados y calcular el precio del combo
            $prod_ids = isset($_POST['prod_id']) ? $_POST['prod_id'] : []; // Array de IDs de productos
            $detalleCombos = [];
            $precioCombo = 0.0;
            $descripcionCombo = '';
    
            foreach ($prod_ids as $prod_id) {
                // Obtener detalles del producto
                $producto = $this->model->obtenerProductoPorId($prod_id);
                if ($producto) { // Asegurarse de que el producto existe
                    $descripcionCombo .= $producto['prod_nombre'] . " " . $producto['prod_descripcion'] . ", ";
                    $precioCombo += round($producto['prod_precio_venta'], 2);
                    // Agregar al detalle del combo
                    $detalleCombos[] = [
                        'prod_id' => $prod_id,
                        'dc_stock' => $dc_stock
                    ];
                }
            }
    
            // Quitar la última coma de la descripción generada
            $descripcionCombo = rtrim($descripcionCombo, ', ');
    
            // Llamar al método editar del modelo
            $this->model->editar($id, $nombre, $descripcionCombo, $precioCombo, $imagenBase64, $cat_id, $detalleCombos);
    
            header("Location: index.php?controller=Combo&action=index");
            exit();
        } else {
            if ($id) {
                $combo = $this->model->obtenerPorId($id);
    
                // Verificar que se encontró el combo antes de proceder
                if ($combo) {
                    // Obtener los detalles del combo
                    $detalles = $this->model->obtenerDetallesPorComboId($id);
    
                    // Obtener los productos y categorías disponibles
                    $productos = $this->model->listarProductos();
                    $categorias = $this->model->listarCategorias();
    
                    require_once 'views/combos/editar.php';
                } else {
                    echo "Combo no encontrado.";
                }
            } else {
                echo "ID de combo no proporcionado.";
            }
        }
    }
    
    

    public function eliminar() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
    
        if ($id) {
            try {
                $result = $this->model->eliminar($id);
    
                if ($result) {
                    header("Location: index.php?controller=Combo&action=index");
                    exit();
                } else {
                    echo "No se pudo eliminar el combo. Intente nuevamente.";
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "ID de combo no proporcionado.";
        }
    }
}