<?php
session_start();
require_once 'config/config.php'; // Archivo de conexión a la base de datos

// Incluir el encabezado con el menú
require_once 'header.php';

// Determinar el controlador y la acción por defecto si no se proporcionan en la URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'Categoria';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Incluir el controlador basado en los parámetros recibidos
$controllerFile = 'controllers/' . ucfirst($controller) . 'Controller.php';
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerName = ucfirst($controller) . 'Controller';
    $controllerObj = new $controllerName();

    // Verificar si la acción existe en el controlador
    if (method_exists($controllerObj, $action)) {
        // Ejecutar la acción del controlador
        $controllerObj->$action();
    } else {
        // Acción no encontrada
        echo "Acción no encontrada";
    }
} else {
    // Controlador no encontrado
    echo "Controlador no encontrado";
}

// Incluir pie de página (si es necesario)
// require_once 'views/footer.php';
?>
