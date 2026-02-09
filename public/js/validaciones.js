/**
 * Validaciones del lado del cliente
 */

document.addEventListener('DOMContentLoaded', function() {
    const formProducto = document.getElementById('formProducto');
    
    if (formProducto) {
        // Validación en tiempo real
        formProducto.addEventListener('submit', function(e) {
            if (!validarFormulario()) {
                e.preventDefault();
                return false;
            }
        });

        // Validar campos en tiempo real
        const codigo = document.getElementById('codigo');
        const nombre = document.getElementById('nombre');
        const precio = document.getElementById('precio');
        const stock = document.getElementById('stock');
        const stockMinimo = document.getElementById('stock_minimo');
        const categoria = document.getElementById('categoria');

        if (codigo) {
            codigo.addEventListener('blur', function() {
                validarCodigo(this);
            });
            codigo.addEventListener('input', function() {
                this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
            });
        }

        if (nombre) {
            nombre.addEventListener('blur', function() {
                validarNombre(this);
            });
        }

        if (precio) {
            precio.addEventListener('blur', function() {
                validarPrecio(this);
            });
            precio.addEventListener('input', function() {
                if (this.value < 0) this.value = 0;
            });
        }

        if (stock) {
            stock.addEventListener('blur', function() {
                validarStock(this);
            });
            stock.addEventListener('input', function() {
                if (this.value < 0) this.value = 0;
                this.value = Math.floor(this.value);
            });
        }

        if (stockMinimo) {
            stockMinimo.addEventListener('blur', function() {
                validarStockMinimo(this);
            });
            stockMinimo.addEventListener('input', function() {
                if (this.value < 0) this.value = 0;
                this.value = Math.floor(this.value);
            });
        }

        if (categoria) {
            categoria.addEventListener('change', function() {
                validarCategoria(this);
            });
        }
    }
});

/**
 * Validar todo el formulario
 */
function validarFormulario() {
    let esValido = true;
    const errores = [];

    const codigo = document.getElementById('codigo');
    const nombre = document.getElementById('nombre');
    const categoria = document.getElementById('categoria');
    const precio = document.getElementById('precio');
    const stock = document.getElementById('stock');
    const stockMinimo = document.getElementById('stock_minimo');

    // Validar código
    if (!validarCodigo(codigo)) {
        esValido = false;
        errores.push('El código del producto es inválido');
    }

    // Validar nombre
    if (!validarNombre(nombre)) {
        esValido = false;
        errores.push('El nombre del producto es inválido');
    }

    // Validar categoría
    if (!validarCategoria(categoria)) {
        esValido = false;
        errores.push('Debe seleccionar una categoría');
    }

    // Validar precio
    if (!validarPrecio(precio)) {
        esValido = false;
        errores.push('El precio debe ser un número positivo');
    }

    // Validar stock
    if (!validarStock(stock)) {
        esValido = false;
        errores.push('El stock debe ser un número entero positivo');
    }

    // Validar stock mínimo
    if (!validarStockMinimo(stockMinimo)) {
        esValido = false;
        errores.push('El stock mínimo debe ser un número entero positivo');
    }

    if (!esValido) {
        mostrarErrores(errores);
    }

    return esValido;
}

/**
 * Validar código del producto
 */
function validarCodigo(campo) {
    if (!campo) return true;
    
    const valor = campo.value.trim();
    
    if (valor === '') {
        marcarError(campo, 'El código es obligatorio');
        return false;
    }
    
    if (valor.length > 50) {
        marcarError(campo, 'El código no puede tener más de 50 caracteres');
        return false;
    }
    
    if (!/^[A-Z0-9]+$/.test(valor)) {
        marcarError(campo, 'El código solo puede contener letras mayúsculas y números');
        return false;
    }
    
    marcarValido(campo);
    return true;
}

/**
 * Validar nombre del producto
 */
function validarNombre(campo) {
    if (!campo) return true;
    
    const valor = campo.value.trim();
    
    if (valor === '') {
        marcarError(campo, 'El nombre es obligatorio');
        return false;
    }
    
    if (valor.length < 3) {
        marcarError(campo, 'El nombre debe tener al menos 3 caracteres');
        return false;
    }
    
    if (valor.length > 100) {
        marcarError(campo, 'El nombre no puede tener más de 100 caracteres');
        return false;
    }
    
    marcarValido(campo);
    return true;
}

/**
 * Validar categoría
 */
function validarCategoria(campo) {
    if (!campo) return true;
    
    if (campo.value === '') {
        marcarError(campo, 'Debe seleccionar una categoría');
        return false;
    }
    
    marcarValido(campo);
    return true;
}

/**
 * Validar precio
 */
function validarPrecio(campo) {
    if (!campo) return true;
    
    const valor = parseFloat(campo.value);
    
    if (isNaN(valor) || valor < 0) {
        marcarError(campo, 'El precio debe ser un número positivo');
        return false;
    }
    
    if (valor === 0) {
        marcarError(campo, 'El precio debe ser mayor que cero');
        return false;
    }
    
    marcarValido(campo);
    return true;
}

/**
 * Validar stock
 */
function validarStock(campo) {
    if (!campo) return true;
    
    const valor = parseInt(campo.value);
    
    if (isNaN(valor) || valor < 0) {
        marcarError(campo, 'El stock debe ser un número entero positivo');
        return false;
    }
    
    if (!Number.isInteger(parseFloat(campo.value))) {
        marcarError(campo, 'El stock debe ser un número entero');
        return false;
    }
    
    marcarValido(campo);
    return true;
}

/**
 * Validar stock mínimo
 */
function validarStockMinimo(campo) {
    if (!campo) return true;
    
    const valor = parseInt(campo.value);
    
    if (isNaN(valor) || valor < 0) {
        marcarError(campo, 'El stock mínimo debe ser un número entero positivo');
        return false;
    }
    
    if (!Number.isInteger(parseFloat(campo.value))) {
        marcarError(campo, 'El stock mínimo debe ser un número entero');
        return false;
    }
    
    marcarValido(campo);
    return true;
}

/**
 * Marcar campo con error
 */
function marcarError(campo, mensaje) {
    campo.style.borderColor = '#e74c3c';
    
    // Remover mensaje de error anterior si existe
    const errorAnterior = campo.parentElement.querySelector('.error-mensaje');
    if (errorAnterior) {
        errorAnterior.remove();
    }
    
    // Agregar mensaje de error
    const errorDiv = document.createElement('small');
    errorDiv.className = 'error-mensaje';
    errorDiv.style.color = '#e74c3c';
    errorDiv.style.display = 'block';
    errorDiv.style.marginTop = '5px';
    errorDiv.textContent = mensaje;
    campo.parentElement.appendChild(errorDiv);
}

/**
 * Marcar campo como válido
 */
function marcarValido(campo) {
    campo.style.borderColor = '#27ae60';
    
    // Remover mensaje de error si existe
    const errorAnterior = campo.parentElement.querySelector('.error-mensaje');
    if (errorAnterior) {
        errorAnterior.remove();
    }
}

/**
 * Mostrar errores en un alert
 */
function mostrarErrores(errores) {
    const mensaje = 'Por favor corrija los siguientes errores:\n\n' + errores.join('\n');
    alert(mensaje);
}

/**
 * Confirmar eliminación
 */
function confirmarEliminacion(mensaje) {
    return confirm(mensaje || '¿Está seguro de que desea eliminar este registro?');
}

/**
 * Formatear precio mientras se escribe
 */
function formatearPrecio(campo) {
    let valor = campo.value.replace(/[^\d.]/g, '');
    const partes = valor.split('.');
    
    if (partes.length > 2) {
        valor = partes[0] + '.' + partes.slice(1).join('');
    }
    
    if (partes[1] && partes[1].length > 2) {
        valor = partes[0] + '.' + partes[1].substring(0, 2);
    }
    
    campo.value = valor;
}
