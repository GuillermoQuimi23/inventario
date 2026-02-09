<?php
/**
 * Clase Database - Manejo de conexión a la base de datos
 */

class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $charset;
    private $conn;

public function __construct() {
    $this->host = getenv('DB_HOST');
    $this->db_name = getenv('DB_NAME');
    $this->username = getenv('DB_USER');
    $this->password = getenv('DB_PASS');
    $this->charset = 'utf8mb4';
}

    /**
     * Obtener la conexión a la base de datos
     */
    public function getConnection() {
        $this->conn = null;

        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=" . $this->charset;
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            die();
        }

        return $this->conn;
    }
}
