export const domPedidos = {
    crearItemModal: function (nombre, cantidad, precio) {
        // Crear el contenedor principal
        const productoItem = document.createElement("div");
        productoItem.className = "producto-item";

        // Crear el div row
        const row = document.createElement("div");
        row.className = "row align-items-center";

        // Crear la columna izquierda (información del producto)
        const colInfo = document.createElement("div");
        colInfo.className = "col-8";

        // Crear el elemento para el nombre del producto
        const nombreProducto = document.createElement("small");
        nombreProducto.className = "fw-semibold poppins-light";
        nombreProducto.textContent = nombre;

        // Crear el salto de línea
        const br = document.createElement("br");

        // Crear el elemento para la cantidad
        const cantidadProducto = document.createElement("small");
        cantidadProducto.className = "text-muted poppins-light";
        cantidadProducto.textContent = `Cantidad: ${cantidad}`;

        // Agregar elementos a la columna de información
        colInfo.appendChild(nombreProducto);
        colInfo.appendChild(br);
        colInfo.appendChild(cantidadProducto);

        // Crear la columna derecha (precio)
        const colPrecio = document.createElement("div");
        colPrecio.className = "col-4 text-end";

        // Crear el elemento para el precio
        const precioProducto = document.createElement("small");
        precioProducto.className = "fw-semibold poppins-light";
        precioProducto.textContent = `$${precio * cantidad}`;

        // Agregar precio a su columna
        colPrecio.appendChild(precioProducto);

        // Ensamblar todo
        row.appendChild(colInfo);
        row.appendChild(colPrecio);
        productoItem.appendChild(row);

        return productoItem;
    },
    crearPedido: function ({ idPedido, direccion, estado, fecha, total }) {
        // Crear el elemento principal de la columna
        const col = document.createElement("div");
        col.className = "col-12 col-lg-6 mb-4";
        col.id = `item-${idPedido}`;

        // Crear la estructura de la card
        col.innerHTML = `
        <div class="card pedido-card">
            <div class="pedido-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 poppins-bold">Pedido <span class="poppins-bold order-number">#${idPedido}</span></h6>
                        <small class="poppins-light fecha-pedido">Realizado el ${fecha}</small>
                    </div>
                    <span class="status-badge ${this.obtenerClaseEstado(estado)}">
                        <i class="${this.obtenerIconoEstado(estado)} me-1"></i>${estado}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <!-- Dirección de entrega -->
                <div class="mb-3">
                    <h6 class="poppins-light text-muted mb-2"><i class="fas fa-map-marker-alt me-2"></i>Dirección de entrega</h6>
                    <p class="mb-0 poppins-light small">${direccion}</p>
                </div>
                <!-- Productos del pedido -->
                <div class="mb-3">
                    <button data-bs-toggle="modal" id="${idPedido}" data-bs-target="#mostrarDetalle" type="button" class="btn boton-fondo-morado poppins-light">
                        <i class="fas fa-box me-2"></i>Productos
                    </button>
                    <h6 class="text-muted mb-2"></h6>
                </div>
                <!-- Total y acciones -->
                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                    <div>
                        <span class="poppins-light total-amount">Total: $${this.formatearPrecio(total)}</span>
                    </div>
                   ${
                       estado !== "entregado"
                           ? `<button id="${idPedido}" class="btn eliminar poppins-light boton-danger-custom btn-sm">
                                            <i id="${idPedido}" class="fas eliminar fa-times me-1"></i>Cancelar
                                        </button>`
                           : ""
                   }
                </div>
            </div>
        </div>
    `;

        return col;
    },

    // Función auxiliar para obtener la clase CSS según el estado
    obtenerClaseEstado: function (estado) {
        const clases = {
            "En proceso": "status-pendiente",
            enviado: "status-enviado",
            entregado: "status-entregado",
        };
        return clases[estado] || "status-pendiente";
    },

    // Función auxiliar para obtener el icono según el estado
    obtenerIconoEstado: function (estado) {
        const iconos = {
            "En proceso": "fas fa-hourglass-half",
            enviado: "fas fa-shipping-fast",
            entregado: "fas fa-check-circle",
        };
        return iconos[estado] || "fas fa-hourglass-half";
    },

    // Función auxiliar para formatear el precio
    formatearPrecio: function (precio) {
        return precio.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },
};
