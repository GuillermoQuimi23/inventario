<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?> - Detalle del Producto</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1><?php echo APP_NAME; ?></h1>
            <p class="subtitle">Detalle del Producto</p>
        </header>

        <div class="card">
            <div class="card-header">
                <h2><?php echo htmlspecialchars($this->producto->nombre); ?></h2>
                <span class="badge badge-category"><?php echo htmlspecialchars($this->producto->categoria); ?></span>
            </div>

            <div class="detail-view">
                <div class="detail-row">
                    <div class="detail-label">Código:</div>
                    <div class="detail-value">
                        <strong><?php echo htmlspecialchars($this->producto->codigo); ?></strong>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Nombre:</div>
                    <div class="detail-value"><?php echo htmlspecialchars($this->producto->nombre); ?></div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Descripción:</div>
                    <div class="detail-value">
                        <?php echo $this->producto->descripcion ? htmlspecialchars($this->producto->descripcion) : '<em>Sin descripción</em>'; ?>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Categoría:</div>
                    <div class="detail-value">
                        <span class="badge badge-category"><?php echo htmlspecialchars($this->producto->categoria); ?></span>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Precio:</div>
                    <div class="detail-value price-large">
                        $<?php echo number_format($this->producto->precio, 2); ?> USD
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Stock Actual:</div>
                    <div class="detail-value">
                        <span class="badge <?php echo $this->producto->stock <= $this->producto->stock_minimo ? 'badge-danger' : 'badge-success'; ?> badge-large">
                            <?php echo $this->producto->stock; ?> unidades
                        </span>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Stock Mínimo:</div>
                    <div class="detail-value"><?php echo $this->producto->stock_minimo; ?> unidades</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Estado del Stock:</div>
                    <div class="detail-value">
                        <?php if($this->producto->stock <= $this->producto->stock_minimo): ?>
                            <span class="badge badge-danger">⚠️ Stock Bajo - Requiere reabastecimiento</span>
                        <?php elseif($this->producto->stock <= ($this->producto->stock_minimo * 2)): ?>
                            <span class="badge badge-warning">⚡ Stock Moderado</span>
                        <?php else: ?>
                            <span class="badge badge-success">✅ Stock Normal</span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Fecha de Registro:</div>
                    <div class="detail-value"><?php echo date('d/m/Y H:i:s', strtotime($this->producto->fecha_registro)); ?></div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Última Actualización:</div>
                    <div class="detail-value"><?php echo date('d/m/Y H:i:s', strtotime($this->producto->fecha_actualizacion)); ?></div>
                </div>
            </div>

            <div class="form-actions">
                <a href="index.php?accion=editar&id=<?php echo $this->producto->id; ?>" class="btn btn-warning">
                    <span class="icon">✏️</span> Editar
                </a>
                <a href="index.php" class="btn btn-secondary">
                    <span class="icon">↩️</span> Volver al Listado
                </a>
                <a href="index.php?accion=eliminar&id=<?php echo $this->producto->id; ?>" 
                   class="btn btn-danger" 
                   onclick="return confirm('¿Está seguro de eliminar este producto?')">
                    <span class="icon">🗑️</span> Eliminar
                </a>
            </div>
        </div>

       
    </div>

    <script src="js/scripts.js"></script>
</body>
</html>
