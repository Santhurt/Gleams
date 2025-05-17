export const dom = {
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
};
