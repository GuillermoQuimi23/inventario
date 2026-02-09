/**
 * Scripts generales del sistema
 */

document.addEventListener('DOMContentLoaded', function() {
    // Auto-ocultar alertas después de 5 segundos
    const alertas = document.querySelectorAll('.alert');
    alertas.forEach(function(alerta) {
        setTimeout(function() {
            alerta.style.transition = 'opacity 0.5s ease';
            alerta.style.opacity = '0';
            setTimeout(function() {
                alerta.remove();
            }, 500);
        }, 5000);
    });

    // Agregar funcionalidad de búsqueda en la tabla
    agregarBusquedaTabla();

    // Resaltar filas con stock bajo
    resaltarStockBajo();

    // Agregar tooltips
    agregarTooltips();
});

/**
 * Agregar funcionalidad de búsqueda en la tabla
 */
function agregarBusquedaTabla() {
    const tabla = document.querySelector('.table');
    if (!tabla) return;

    // Crear campo de búsqueda
    const cardHeader = document.querySelector('.card-header');
    if (cardHeader && !document.getElementById('busqueda')) {
        const divBusqueda = document.createElement('div');
        divBusqueda.innerHTML = `
            <input type="text" 
                   id="busqueda" 
                   placeholder="🔍 Buscar producto..." 
                   style="padding: 8px 15px; 
                          border: 2px solid #ddd; 
                          border-radius: 6px; 
                          font-size: 0.9rem;
                          min-width: 250px;">
        `;
        cardHeader.appendChild(divBusqueda);

        // Evento de búsqueda
        const campoBusqueda = document.getElementById('busqueda');
        campoBusqueda.addEventListener('keyup', function() {
            const filtro = this.value.toLowerCase();
            const filas = tabla.querySelectorAll('tbody tr');

            filas.forEach(function(fila) {
                const texto = fila.textContent.toLowerCase();
                if (texto.includes(filtro)) {
                    fila.style.display = '';
                } else {
                    fila.style.display = 'none';
                }
            });
        });
    }
}

/**
 * Resaltar filas con stock bajo
 */
function resaltarStockBajo() {
    const filas = document.querySelectorAll('.table tbody tr');
    
    filas.forEach(function(fila) {
        const badgesEstado = fila.querySelectorAll('.badge-danger');
        if (badgesEstado.length > 0) {
            fila.style.backgroundColor = '#fff5f5';
        }
    });
}

/**
 * Agregar tooltips a los botones
 */
function agregarTooltips() {
    const botones = document.querySelectorAll('[title]');
    
    botones.forEach(function(boton) {
        boton.addEventListener('mouseenter', function(e) {
            const tooltip = document.createElement('div');
            tooltip.className = 'tooltip-custom';
            tooltip.textContent = this.getAttribute('title');
            tooltip.style.cssText = `
                position: absolute;
                background-color: #2c3e50;
                color: white;
                padding: 5px 10px;
                border-radius: 4px;
                font-size: 0.85rem;
                z-index: 1000;
                white-space: nowrap;
                pointer-events: none;
            `;
            
            document.body.appendChild(tooltip);
            
            const rect = this.getBoundingClientRect();
            tooltip.style.top = (rect.top - tooltip.offsetHeight - 5) + 'px';
            tooltip.style.left = (rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2)) + 'px';
            
            this.tooltipElement = tooltip;
        });
        
        boton.addEventListener('mouseleave', function() {
            if (this.tooltipElement) {
                this.tooltipElement.remove();
                this.tooltipElement = null;
            }
        });
    });
}

/**
 * Animar números (contador)
 */
function animarNumero(elemento, inicio, fin, duracion) {
    let inicioTimestamp = null;
    const paso = (timestamp) => {
        if (!inicioTimestamp) inicioTimestamp = timestamp;
        const progreso = Math.min((timestamp - inicioTimestamp) / duracion, 1);
        elemento.textContent = Math.floor(progreso * (fin - inicio) + inicio);
        if (progreso < 1) {
            window.requestAnimationFrame(paso);
        }
    };
    window.requestAnimationFrame(paso);
}

/**
 * Confirmar acción
 */
function confirmar(mensaje) {
    return confirm(mensaje);
}

/**
 * Formatear moneda
 */
function formatearMoneda(numero) {
    return new Intl.NumberFormat('es-EC', {
        style: 'currency',
        currency: 'USD'
    }).format(numero);
}

/**
 * Imprimir página
 */
function imprimirPagina() {
    window.print();
}

/**
 * Exportar tabla a CSV (función básica)
 */
function exportarCSV() {
    const tabla = document.querySelector('.table');
    if (!tabla) return;

    let csv = [];
    const filas = tabla.querySelectorAll('tr');

    filas.forEach(function(fila) {
        const cols = fila.querySelectorAll('td, th');
        const fila_data = [];
        
        cols.forEach(function(col) {
            // Excluir columna de acciones
            if (!col.classList.contains('actions')) {
                fila_data.push(col.textContent.trim());
            }
        });
        
        csv.push(fila_data.join(','));
    });

    // Descargar archivo
    const csvString = csv.join('\n');
    const blob = new Blob([csvString], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'inventario_' + new Date().getTime() + '.csv';
    a.click();
}
