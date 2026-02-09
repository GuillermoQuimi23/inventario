<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?> - Editar Producto</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1><?php echo APP_NAME; ?></h1>
            <p class="subtitle">Editar Producto</p>
        </header>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?php 
                echo $_SESSION['error']; 
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header">
                <h2>Actualizar Datos del Producto</h2>
            </div>

            <form id="formProducto" action="index.php?accion=actualizar" method="POST" class="form">
                <input type="hidden" name="id" value="<?php echo $this->producto->id; ?>">

                <div class="form-row">
                    <div class="form-group">
                        <label for="codigo">Código del Producto <span class="required">*</span></label>
                        <input type="text" 
                               id="codigo" 
                               name="codigo" 
                               class="form-control" 
                               value="<?php echo htmlspecialchars($this->producto->codigo); ?>"
                               required
                               maxlength="50">
                        <small class="form-text">Código único del producto</small>
                    </div>

                    <div class="form-group">
                        <label for="categoria">Categoría <span class="required">*</span></label>
                        <select id="categoria" name="categoria" class="form-control" required>
                            <option value="">Seleccione una categoría</option>
                            <option value="Electrónica" <?php echo $this->producto->categoria == 'Electrónica' ? 'selected' : ''; ?>>Electrónica</option>
                            <option value="Accesorios" <?php echo $this->producto->categoria == 'Accesorios' ? 'selected' : ''; ?>>Accesorios</option>
                            <option value="Audio" <?php echo $this->producto->categoria == 'Audio' ? 'selected' : ''; ?>>Audio</option>
                            <option value="Computadoras" <?php echo $this->producto->categoria == 'Computadoras' ? 'selected' : ''; ?>>Computadoras</option>
                            <option value="Periféricos" <?php echo $this->producto->categoria == 'Periféricos' ? 'selected' : ''; ?>>Periféricos</option>
                            <option value="Otros" <?php echo $this->producto->categoria == 'Otros' ? 'selected' : ''; ?>>Otros</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre del Producto <span class="required">*</span></label>
                    <input type="text" 
                           id="nombre" 
                           name="nombre" 
                           class="form-control" 
                           value="<?php echo htmlspecialchars($this->producto->nombre); ?>"
                           required
                           maxlength="100">
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" 
                              name="descripcion" 
                              class="form-control" 
                              rows="3"><?php echo htmlspecialchars($this->producto->descripcion); ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="precio">Precio (USD) <span class="required">*</span></label>
                        <input type="number" 
                               id="precio" 
                               name="precio" 
                               class="form-control" 
                               value="<?php echo $this->producto->precio; ?>"
                               step="0.01"
                               min="0"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock Actual <span class="required">*</span></label>
                        <input type="number" 
                               id="stock" 
                               name="stock" 
                               class="form-control" 
                               value="<?php echo $this->producto->stock; ?>"
                               min="0"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="stock_minimo">Stock Mínimo <span class="required">*</span></label>
                        <input type="number" 
                               id="stock_minimo" 
                               name="stock_minimo" 
                               class="form-control" 
                               value="<?php echo $this->producto->stock_minimo; ?>"
                               min="0"
                               required>
                        <small class="form-text">Alerta cuando el stock sea igual o menor a este valor</small>
                    </div>
                </div>

                <div class="info-box">
                    <p><strong>Fecha de registro:</strong> <?php echo date('d/m/Y H:i', strtotime($this->producto->fecha_registro)); ?></p>
                    <p><strong>Última actualización:</strong> <?php echo date('d/m/Y H:i', strtotime($this->producto->fecha_actualizacion)); ?></p>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <span class="icon">💾</span> Actualizar Producto
                    </button>
                    <a href="index.php" class="btn btn-secondary">
                        <span class="icon">↩️</span> Cancelar
                    </a>
                </div>
            </form>
        </div>

    </div>

    <script src="js/scripts.js"></script>
    <script src="js/validaciones.js"></script>
</body>
</html>
