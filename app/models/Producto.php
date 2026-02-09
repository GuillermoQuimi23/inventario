<?php
/**
 * Modelo Producto - Gestión de productos en la base de datos
 */

class Producto {
    private $conn;
    private $table_name = "productos";

    // Propiedades del producto
    public $id;
    public $codigo;
    public $nombre;
    public $descripcion;
    public $categoria;
    public $precio;
    public $stock;
    public $stock_minimo;
    public $fecha_registro;
    public $fecha_actualizacion;

    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Obtener todos los productos
     */
    public function obtenerTodos() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY fecha_actualizacion DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Obtener un producto por ID
     */
    public function obtenerPorId() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch();
        
        if($row) {
            $this->codigo = $row['codigo'];
            $this->nombre = $row['nombre'];
            $this->descripcion = $row['descripcion'];
            $this->categoria = $row['categoria'];
            $this->precio = $row['precio'];
            $this->stock = $row['stock'];
            $this->stock_minimo = $row['stock_minimo'];
            $this->fecha_registro = $row['fecha_registro'];
            $this->fecha_actualizacion = $row['fecha_actualizacion'];
            return true;
        }
        
        return false;
    }

    /**
     * Crear un nuevo producto
     */
    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (codigo, nombre, descripcion, categoria, precio, stock, stock_minimo) 
                  VALUES (:codigo, :nombre, :descripcion, :categoria, :precio, :stock, :stock_minimo)";
        
        $stmt = $this->conn->prepare($query);

        // Limpiar datos
        $this->codigo = htmlspecialchars(strip_tags($this->codigo));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->categoria = htmlspecialchars(strip_tags($this->categoria));
        $this->precio = htmlspecialchars(strip_tags($this->precio));
        $this->stock = htmlspecialchars(strip_tags($this->stock));
        $this->stock_minimo = htmlspecialchars(strip_tags($this->stock_minimo));

        // Vincular valores
        $stmt->bindParam(':codigo', $this->codigo);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':categoria', $this->categoria);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':stock', $this->stock);
        $stmt->bindParam(':stock_minimo', $this->stock_minimo);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Actualizar un producto existente
     */
    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " 
                  SET codigo = :codigo, 
                      nombre = :nombre, 
                      descripcion = :descripcion, 
                      categoria = :categoria, 
                      precio = :precio, 
                      stock = :stock, 
                      stock_minimo = :stock_minimo 
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);

        // Limpiar datos
        $this->codigo = htmlspecialchars(strip_tags($this->codigo));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->categoria = htmlspecialchars(strip_tags($this->categoria));
        $this->precio = htmlspecialchars(strip_tags($this->precio));
        $this->stock = htmlspecialchars(strip_tags($this->stock));
        $this->stock_minimo = htmlspecialchars(strip_tags($this->stock_minimo));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Vincular valores
        $stmt->bindParam(':codigo', $this->codigo);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':categoria', $this->categoria);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':stock', $this->stock);
        $stmt->bindParam(':stock_minimo', $this->stock_minimo);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Eliminar un producto
     */
    public function eliminar() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Verificar si el código ya existe
     */
    public function codigoExiste() {
        $query = "SELECT id FROM " . $this->table_name . " WHERE codigo = :codigo";
        
        if(isset($this->id)) {
            $query .= " AND id != :id";
        }
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo', $this->codigo);
        
        if(isset($this->id)) {
            $stmt->bindParam(':id', $this->id);
        }
        
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }

    /**
     * Obtener productos con stock bajo
     */
    public function obtenerStockBajo() {
        $query = "SELECT * FROM " . $this->table_name . " 
                  WHERE stock <= stock_minimo 
                  ORDER BY stock ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
