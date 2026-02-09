<?php
/**
 * Controlador Frontal - Punto de entrada de la aplicación
 */

// Iniciar sesión
session_start();

// Cargar configuración
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/controllers/ProductoController.php';

// Crear instancia del controlador
$controller = new ProductoController();

// Obtener la acción solicitada
$accion = isset($_GET['accion']) ? $_GET['accion'] : 'listar';

// Enrutar a la acción correspondiente
switch ($accion) {
    case 'crear':
        $controller->crear();
        break;
    
    case 'guardar':
        $controller->guardar();
        break;
    
    case 'editar':
        $controller->editar();
        break;
    
    case 'actualizar':
        $controller->actualizar();
        break;
    
    case 'eliminar':
        $controller->eliminar();
        break;
    
    case 'ver':
        $controller->ver();
        break;
    
    case 'listar':
    default:
        $controller->listar();
        break;
}
