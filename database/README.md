# Proyecto CRUD PHP y MySQL - Inventario de Productos

## Descripción
Aplicación web desarrollada en PHP y MySQL que permite la gestión de productos mediante operaciones CRUD (Crear, Leer, Actualizar y Eliminar), aplicando el patrón de arquitectura MVC (Modelo–Vista–Controlador).

El sistema permite registrar, visualizar, editar y eliminar productos desde una interfaz web amigable, con validaciones tanto en el frontend como en el backend.



## Tecnologías utilizadas
- PHP 8
- MySQL
- HTML5
- CSS3
- JavaScript
- Apache (XAMPP)
- Git y GitHub


## Estructura del proyecto
/app  
/controllers  
/models  
/views/productos  
/config  
/database  
  └─ database.sql  
  └─ README.md

/public  
/css  
/js  
/.htaccess  
index.php 
  


## Requisitos previos
- Tener instalado XAMPP o WAMP
- PHP 8 o superior
- MySQL
- Navegador web


## Instalación y ejecución

### 1. Clonar el repositorio
git clone https://github.com/tu-usuario/tu-repositorio.git

### 2. Copiar el proyecto
Mover la carpeta del proyecto a:
C:\xampp\htdocs\

### 3. Crear la base de datos
1. Abrir phpMyAdmin  
2. Crear una base de datos (por ejemplo): inventario_db  
3. Importar el archivo database.sql  

---

### 4. Configurar la conexión a la base de datos
Editar el archivo:
config/Database.php

Verificar los datos de conexión:
host: localhost  
db_name: inventario_db  
username: root  
password:  


### 5. Ejecutar la aplicación
Abrir el navegador y escribir:
http://localhost/nombre-del-proyecto/public/


## Funcionalidades principales
- Registro de productos
- Listado de productos
- Edición de productos
- Eliminación de productos
- Validaciones en frontend y backend
- Arquitectura MVC


## Autor
Guillermo Orlando Quimi Rugel  
Ingeniería en Sistemas Computacionales  
Universidad de Guayaquil
