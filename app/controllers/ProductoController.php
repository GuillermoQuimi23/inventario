<?php
/**
 * Controlador de Productos - Lógica de negocio
 */

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../models/Producto.php';

class ProductoController {
    private $db;
    private $producto;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->producto = new Producto($this->db);
    }

    /**
     * Listar todos los productos
     */
    public function listar() {
        $stmt = $this->producto->obtenerTodos();
        $productos = $stmt->fetchAll();
        require_once __DIR__ . '/../views/productos/listar.php';
    }

    /**
     * Mostrar formulario de crear
     */
    public function crear() {
        require_once __DIR__ . '/../views/productos/crear.php';
    }

    /**
     * Guardar nuevo producto
     */
    public function guardar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validaciones del servidor
            $errores = $this->validarDatos($_POST);

            if(empty($errores)) {
                $this->producto->codigo = $_POST['codigo'];
                $this->producto->nombre = $_POST['nombre'];
                $this->producto->descripcion = $_POST['descripcion'];
                $this->producto->categoria = $_POST['categoria'];
                $this->producto->precio = $_POST['precio'];
                $this->producto->stock = $_POST['stock'];
                $this->producto->stock_minimo = $_POST['stock_minimo'];

                // Verificar si el código ya existe
                if($this->producto->codigoExiste()) {
                    $_SESSION['error'] = "El código del producto ya existe";
                    header("Location: index.php?accion=crear");
                    exit();
                }

                if($this->producto->crear()) {
                    $_SESSION['mensaje'] = "Producto creado exitosamente";
                    header("Location: index.php");
                } else {
                    $_SESSION['error'] = "Error al crear el producto";
                    header("Location: index.php?accion=crear");
                }
            } else {
                $_SESSION['error'] = implode("<br>", $errores);
                header("Location: index.php?accion=crear");
            }
        }
    }

    /**
     * Mostrar formulario de editar
     */
    public function editar() {
        if(isset($_GET['id'])) {
            $this->producto->id = $_GET['id'];
            
            if($this->producto->obtenerPorId()) {
                require_once __DIR__ . '/../views/productos/editar.php';
            } else {
                $_SESSION['error'] = "Producto no encontrado";
                header("Location: index.php");
            }
        }
    }

    /**
     * Actualizar producto existente
     */
    public function actualizar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validaciones del servidor
            $errores = $this->validarDatos($_POST);

            if(empty($errores)) {
                $this->producto->id = $_POST['id'];
                $this->producto->codigo = $_POST['codigo'];
                $this->producto->nombre = $_POST['nombre'];
                $this->producto->descripcion = $_POST['descripcion'];
                $this->producto->categoria = $_POST['categoria'];
                $this->producto->precio = $_POST['precio'];
                $this->producto->stock = $_POST['stock'];
                $this->producto->stock_minimo = $_POST['stock_minimo'];

                // Verificar si el código ya existe en otro producto
                if($this->producto->codigoExiste()) {
                    $_SESSION['error'] = "El código del producto ya existe en otro registro";
                    header("Location: index.php?accion=editar&id=" . $this->producto->id);
                    exit();
                }

                if($this->producto->actualizar()) {
                    $_SESSION['mensaje'] = "Producto actualizado exitosamente";
                    header("Location: index.php");
                } else {
                    $_SESSION['error'] = "Error al actualizar el producto";
                    header("Location: index.php?accion=editar&id=" . $this->producto->id);
                }
            } else {
                $_SESSION['error'] = implode("<br>", $errores);
                header("Location: index.php?accion=editar&id=" . $_POST['id']);
            }
        }
    }

    /**
     * Eliminar producto
     */
    public function eliminar() {
        if(isset($_GET['id'])) {
            $this->producto->id = $_GET['id'];
            
            if($this->producto->eliminar()) {
                $_SESSION['mensaje'] = "Producto eliminado exitosamente";
            } else {
                $_SESSION['error'] = "Error al eliminar el producto";
            }
            
            header("Location: index.php");
        }
    }

    /**
     * Ver detalle de un producto
     */
    public function ver() {
        if(isset($_GET['id'])) {
            $this->producto->id = $_GET['id'];
            
            if($this->producto->obtenerPorId()) {
                require_once __DIR__ . '/../views/productos/ver.php';
            } else {
                $_SESSION['error'] = "Producto no encontrado";
                header("Location: index.php");
            }
        }
    }

    /**
     * Validar datos del formulario
     */
    private function validarDatos($datos) {
        $errores = [];

        // Validar código
        if(empty($datos['codigo'])) {
            $errores[] = "El código es obligatorio";
        } elseif(strlen($datos['codigo']) > 50) {
            $errores[] = "El código no puede tener más de 50 caracteres";
        }

        // Validar nombre
        if(empty($datos['nombre'])) {
            $errores[] = "El nombre es obligatorio";
        } elseif(strlen($datos['nombre']) > 100) {
            $errores[] = "El nombre no puede tener más de 100 caracteres";
        }

        // Validar categoría
        if(empty($datos['categoria'])) {
            $errores[] = "La categoría es obligatoria";
        }

        // Validar precio
        if(empty($datos['precio'])) {
            $errores[] = "El precio es obligatorio";
        } elseif(!is_numeric($datos['precio']) || $datos['precio'] < 0) {
            $errores[] = "El precio debe ser un número positivo";
        }

        // Validar stock
        if(!isset($datos['stock']) || $datos['stock'] === '') {
            $errores[] = "El stock es obligatorio";
        } elseif(!is_numeric($datos['stock']) || $datos['stock'] < 0) {
            $errores[] = "El stock debe ser un número entero positivo";
        }

        // Validar stock mínimo
        if(!isset($datos['stock_minimo']) || $datos['stock_minimo'] === '') {
            $errores[] = "El stock mínimo es obligatorio";
        } elseif(!is_numeric($datos['stock_minimo']) || $datos['stock_minimo'] < 0) {
            $errores[] = "El stock mínimo debe ser un número entero positivo";
        }

        return $errores;
    }
}
