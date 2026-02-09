<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?> - Listado de Productos</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1><?php echo APP_NAME; ?></h1>
            <p class="subtitle">Gestión de Productos</p>
        </header>

        <?php if(isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-success">
                <?php 
                echo $_SESSION['mensaje']; 
                unset($_SESSION['mensaje']);
                ?>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?php 
                echo $_SESSION['error']; 
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <div class="action-bar">
            <a href="index.php?accion=crear" class="btn btn-primary">
                <span class="icon">+</span> Nuevo Producto
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Listado de Productos</h2>
                <span class="badge"><?php echo count($productos); ?> productos</span>
            </div>
            
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Stock Mínimo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($productos) > 0): ?>
                            <?php foreach($productos as $producto): ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($producto['codigo']); ?></strong></td>
                                    <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                                    <td>
                                        <span class="badge badge-category">
                                            <?php echo htmlspecialchars($producto['categoria']); ?>
                                        </span>
                                    </td>
                                    <td class="price">$<?php echo number_format($producto['precio'], 2); ?></td>
                                    <td class="text-center">
                                        <span class="badge <?php echo $producto['stock'] <= $producto['stock_minimo'] ? 'badge-danger' : 'badge-success'; ?>">
                                            <?php echo $producto['stock']; ?>
                                        </span>
                                    </td>
                                    <td class="text-center"><?php echo $producto['stock_minimo']; ?></td>
                                    <td>
                                        <?php if($producto['stock'] <= $producto['stock_minimo']): ?>
                                            <span class="badge badge-danger">Stock Bajo</span>
                                        <?php else: ?>
                                            <span class="badge badge-success">Normal</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="actions">
                                        <a href="index.php?accion=ver&id=<?php echo $producto['id']; ?>" 
                                           class="btn btn-sm btn-info" title="Ver detalle">
                                            👁️
                                        </a>
                                        <a href="index.php?accion=editar&id=<?php echo $producto['id']; ?>" 
                                           class="btn btn-sm btn-warning" title="Editar">
                                            ✏️
                                        </a>
                                        <a href="index.php?accion=eliminar&id=<?php echo $producto['id']; ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('¿Está seguro de eliminar este producto?')"
                                           title="Eliminar">
                                            🗑️
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">No hay productos registrados</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="js/scripts.js"></script>
</body>
</html>
