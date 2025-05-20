export const dom = {
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

        divPrecioSpan.replaceChildren(span, icon);

        div.replaceChildren(h6, small);
        li.replaceChildren(div, divPrecioSpan);

        return li;
    },
    crearCardProducto: (producto) => {
        const divCol = document.createElement("div");
        divCol.classList.add("col-6", "col-md-4", "col-lg-3", "fade-in");

        const divProductoCard = document.createElement("div");
        divProductoCard.classList.add("product-card");

        const img = document.createElement("img");
        img.classList.add("card-img-top", "rounded-3", "img-fluid");
        img.src = `../${producto.imagen.ruta}`;

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

        const p = document.createElement("p");
        p.classList.add("product-price", "poppins-light");
        p.textContent = `${producto.precio}`;

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
        h5.classList.add("product-name", "mb-1");
        h5.textContent = pedido.producto;

        const p = document.createElement("p");
        p.classList.add("product-details", "mb-0", "text-muted");
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
