-- Base de datos para Sistema de Inventario
CREATE DATABASE IF NOT EXISTS inventario_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE inventario_db;

-- Tabla de productos
CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50) NOT NULL UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    categoria VARCHAR(50) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    stock_minimo INT NOT NULL DEFAULT 5,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_codigo (codigo),
    INDEX idx_categoria (categoria)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar datos de ejemplo
INSERT INTO productos (codigo, nombre, descripcion, categoria, precio, stock, stock_minimo) VALUES
('PROD001', 'Laptop Dell XPS 13', 'Laptop ultraportátil con procesador Intel i7', 'Electrónica', 1299.99, 15, 5),
('PROD002', 'Mouse Logitech MX Master 3', 'Mouse inalámbrico ergonómico', 'Accesorios', 99.99, 45, 10),
('PROD003', 'Teclado Mecánico Corsair K95', 'Teclado mecánico RGB para gaming', 'Accesorios', 189.99, 20, 5),
('PROD004', 'Monitor LG UltraWide 34"', 'Monitor curvo 34 pulgadas 3440x1440', 'Electrónica', 599.99, 8, 3),
('PROD005', 'Auriculares Sony WH-1000XM4', 'Auriculares con cancelación de ruido', 'Audio', 349.99, 30, 8);
