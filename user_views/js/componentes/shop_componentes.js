export const dom = {
    verificarCarritoVacio: function () {
        const listaPedidos = document.getElementById("lista-pedidos");
        const productos = listaPedidos.querySelectorAll(
            "li:not(.mensaje-vacio)",
        );

        if (productos.length === 0) {
            this.mostrarCarritoVacio();
        }
    },

    mostrarCarritoVacio: function () {
        const listaPedidos = document.getElementById("lista-pedidos");
        const total = document.getElementById("total");
        const confirmarCompra = document.getElementById("confirmar-compra");

        // Limpiar la lista
        listaPedidos.innerHTML = "";

        // Crear el mensaje de carrito vacío
        const mensajeVacio = document.createElement("li");
        mensajeVacio.className = "list-group-item text-center py-5 border-0";
        mensajeVacio.innerHTML = `
        <div class="text-muted">
            <i class="fas fa-shopping-cart fa-3x mb-3 opacity-50"></i>
            <h6 class="mb-2">No hay productos en el carrito</h6>
            <p class="small mb-0">Agrega algunos productos para continuar con tu compra</p>
        </div>
    `;

        // Agregar el mensaje a la lista
        listaPedidos.appendChild(mensajeVacio);

        // Ocultar o actualizar el total
        total.textContent = "$0.00";

        // Deshabilitar el botón de finalizar compra
        confirmarCompra.classList.add("disabled");
        confirmarCompra.setAttribute("aria-disabled", "true");
    },
    crearComentario: ({ cliente, estrellas, fecha, comentario }) => {
        const divCard = document.createElement("div");
        divCard.classList.add("card", "mb-3", "fondo");

        const cardBody = document.createElement("div");
        cardBody.classList.add("card-body");

        const divCont = document.createElement("div");
        divCont.classList.add("d-flex", "justify-content-between", "mb-2");

        const h5 = document.createElement("h5");
        h5.classList.add("card-title", "poppins-light");
        h5.textContent = cliente;

        const div = document.createElement("div");

        const span = document.createElement("span");
        span.classList.add("text-warning");
        const estrellasLlenas = "★".repeat(estrellas);
        const estrellasVacias = "☆".repeat(5 - estrellas);
        span.textContent = `${estrellasLlenas}${estrellasVacias}`;

        const small = document.createElement("small");
        small.textContent = fecha;

        const pComentario = document.createElement("p");
        pComentario.classList.add("card-text", "poppins-light");
        pComentario.textContent = comentario;

        div.replaceChildren(span, small);
        divCont.replaceChildren(h5, div);

        cardBody.replaceChildren(divCont, pComentario);
        divCard.appendChild(cardBody);

        return divCard;
    },

    contarItemsCarrito: function () {
        let totalItems = 0;
        for (let i = 0; i < localStorage.length; i++) {
            const key = localStorage.key(i);
            // Verificar que la key sea un número (ID del producto)
            if (!isNaN(key) && key !== null) {
                const item = JSON.parse(localStorage.getItem(key));
                if (item && item.cantidad) {
                    totalItems += parseInt(item.cantidad);
                }
            }
        }
        return totalItems;
    },

    actualizarContadorCarrito: function () {
        const iconoCarrito = document.querySelector(
            ".fas.fa-shopping-bag",
        ).parentElement;
        let contador = iconoCarrito.querySelector(".badge");

        const totalItems = this.contarItemsCarrito();

        if (totalItems > 0) {
            if (!contador) {
                // Crear el contador si no existe
                contador = document.createElement("span");
                contador.className =
                    "badge bg-danger rounded-pill position-absolute";
                contador.style.cssText = `
                top: -15px;
                right: -17px;
                font-size: 0.75rem;
                min-width: 20px;
                height: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
            `;
                iconoCarrito.appendChild(contador);
            }
            contador.textContent = totalItems;
            contador.style.display = "flex";
        } else {
            if (contador) {
                contador.style.display = "none";
            }
        }
    },
    mostrarAlertaExito: () => {
        // Crear el elemento de alerta
        const alerta = document.createElement("div");
        alerta.className =
            "alert alert-success alert-dismissible fade show position-fixed";
        alerta.style.cssText = `
        top: 20px;
        right: 20px;
        z-index: 1050;
        min-width: 300px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    `;

        alerta.innerHTML = `
        <i class="fas fa-check-circle me-2"></i>
        <strong>¡Producto agregado al carrito!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

        // Agregar la alerta al body
        document.body.appendChild(alerta);

        // Remover automáticamente después de 3 segundos
        setTimeout(() => {
            if (alerta && alerta.parentNode) {
                alerta.remove();
            }
        }, 3000);
    },

    crearItemCarrito: (pedido) => {
        const li = document.createElement("li");
        li.classList.add(
            "list-group-item",
            "d-flex",
            "justify-content-between",
            "align-items-center",
            "px-0",
            "py-2",
        );

        const div = document.createElement("div");

        const h6 = document.createElement("h6");
        h6.classList.add("mb-1");
        h6.textContent = pedido.nombre;

        const small = document.createElement("small");
        small.classList.add("text-muted");
        small.textContent = `${pedido.cantidad} Unidades`;

        const divPrecioSpan = document.createElement("div");
        divPrecioSpan.classList.add("d-flex", "align-items-center", "gap-2");

        const span = document.createElement("span");
        span.classList.add("fw-semibold");
        span.textContent = `$${pedido.precio}`;

        const icon = document.createElement("i");
        icon.classList.add("quitar-item", "fa-solid", "fa-xmark", "ms-0");
        icon.id = pedido.id;

        const botonIcon = document.createElement("button");
        botonIcon.classList.add(
            "btn",
            "boton-fondo-morado",
            "poppins-light",
            "py-2",
            "quitar-item",
        );
        botonIcon.id = pedido.id;
        botonIcon.appendChild(icon);

        divPrecioSpan.replaceChildren(span, botonIcon);

        div.replaceChildren(h6, small);
        li.replaceChildren(div, divPrecioSpan);

        return li;
    },

    crearCardProducto: (producto) => {
        const divCol = document.createElement("div");
        divCol.classList.add(
            "item-producto",
            "col-6",
            "col-md-4",
            "col-lg-3",
            "fade-in",
        );

        const divProductoCard = document.createElement("div");
        divProductoCard.classList.add("product-card");

        const img = document.createElement("img");
        img.classList.add("card-img-top", "rounded-3", "img-fluid");
        img.src = `../${producto.imagen.ruta}`;
        img.style.height = "300px";

        const cardBody = document.createElement("div");
        cardBody.classList.add(
            "card-body",
            "d-flex",
            "flex-column",
            "flex-md-row",
            "align-items-start",
            "align-items-md-center",
            "px-0",
        );

        const div = document.createElement("div");

        const h4 = document.createElement("h4");
        h4.classList.add("product-title", "playfair-title");
        h4.textContent = `${producto.producto}`;
        h4.id = "nombre-producto";

        const p = document.createElement("p");
        p.classList.add("product-price", "poppins-light");
        p.textContent =
            producto.descuento != 0
                ? `$${producto.precio * (1 - (producto.descuento) / 100)}`
                : `$${producto.precio}`;

        const a = document.createElement("a");
        a.classList.add(
            "btn",
            "ms-0",
            "ms-md-auto",
            "mt-1",
            "mt-md-0",
            "boton-fondo-morado",
        );
        a.href = `./producto.php?id=${producto.id_producto}`;

        const icon = document.createElement("i");
        icon.classList.add("bi", "bi-bag-plus");

        div.replaceChildren(h4, p);
        a.replaceChildren(icon);

        cardBody.replaceChildren(div, a);

        divProductoCard.replaceChildren(img, cardBody);

        divCol.appendChild(divProductoCard);

        return divCol;
    },

    crearItemPago: (pedido) => {
        const productItem = document.createElement("div");
        productItem.classList.add(
            "product-item",
            "d-flex",
            "align-items-center",
            "mb-2",
        );

        const divInfo = document.createElement("div");
        divInfo.classList.add("flex-grow-1");

        const h5 = document.createElement("h5");
        h5.classList.add("product-name", "mb-1", "poppins-light");
        h5.textContent = pedido.producto;

        const p = document.createElement("p");
        p.classList.add(
            "product-details",
            "mb-0",
            "text-muted",
            "poppins-light",
        );
        p.textContent = `Cantidad: ${pedido.cantidad}`;

        divInfo.replaceChildren(h5, p);

        const divTotal = document.createElement("div");
        divTotal.classList.add("ms-3", "text-end");

        const span = document.createElement("span");
        span.classList.add("fw-bold");
        span.textContent = `$${pedido.cantidad * pedido.precio}`;

        divTotal.appendChild(span);

        productItem.replaceChildren(divInfo, divTotal);

        return productItem;
    },
};
