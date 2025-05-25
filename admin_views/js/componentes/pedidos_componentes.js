export const dom = {
    crearRow: (pedido) => {
        const contenedor = document.createElement("div");
        contenedor.classList.add("d-flex", "gap-2");

        const botonInfo = document.createElement("button");
        botonInfo.innerHTML = `<i id="${pedido["ID pedido"]}" class="fas fa-info-circle"></i>`;
        botonInfo.classList.add("btn", "btn-primary");
        botonInfo.id = pedido["ID pedido"];
        botonInfo.setAttribute("data-bs-toggle", "modal");
        botonInfo.setAttribute("data-bs-target", "#modal-info");

        const botonConfirmar = document.createElement("button");
        botonConfirmar.innerHTML = `<i id="${pedido["ID pedido"]}" class="fas fa-check-circle confirmar"></i>`;
        botonConfirmar.classList.add("btn", "btn-success", "confirmar");
        botonConfirmar.id = pedido["ID pedido"];

        const botonEliminar = document.createElement("button");
        botonEliminar.innerHTML = ` <i id="${pedido["ID pedido"]}" class="fas fa-trash-alt eliminar"></i>`;
        botonEliminar.classList.add("btn", "btn-danger", "eliminar");
        botonEliminar.id = pedido["ID pedido"];

        contenedor.replaceChildren(botonInfo, botonConfirmar, botonEliminar);
        pedido["acciones"] = contenedor;
        const tr = document.createElement("tr");

        const campos = [];

        const tds = Object.keys(pedido).map((campo) => {
            const td = document.createElement("td");

            if (campo == "acciones") {
                td.appendChild(pedido[campo]);
            } else {
                td.innerHTML = pedido[campo];
            }

            if (!campos.includes(campo)) {
                campos.push(campo);
            }

            td.classList.add("text-center");

            return td;
        });

        tr.replaceChildren(...tds);
        tr.id = "pedido-" + pedido["ID pedido"];

        return tr;
    },

    crearTabla: (pedidos) => {
        const table = document.createElement("table");
        table.id = "pedidos";
        table.classList.add(
            "table",
            "align-middle",
            "table-hover",
            "table-borderless",
            "table-striped",
        );

        const tbody = document.createElement("tbody");
        tbody.id = "t-pedidos";
        const campos = [];

        const rows = pedidos.map((pedido) => {
            const contenedor = document.createElement("div");
            contenedor.classList.add("d-flex", "gap-2");

            const botonInfo = document.createElement("button");
            botonInfo.innerHTML = `<i class="fas fa-info-circle"></i>`;
            botonInfo.classList.add("btn", "btn-primary");
            botonInfo.id = pedido["ID pedido"];
            botonInfo.setAttribute("data-bs-toggle", "modal");
            botonInfo.setAttribute("data-bs-target", "#modal-info");

            const botonConfirmar = document.createElement("button");
            botonConfirmar.innerHTML = `<i id="${pedido["ID pedido"]}" class="fas fa-check-circle confirmar"></i>`;
            botonConfirmar.classList.add("btn", "btn-success", "confirmar");
            botonConfirmar.id = pedido["ID pedido"];

            const botonEliminar = document.createElement("button");
            botonEliminar.innerHTML = `<i id="${pedido["ID pedido"]}" class="fas fa-trash-alt eliminar"></i>`;
            botonEliminar.classList.add("btn", "btn-danger", "eliminar");
            botonEliminar.id = pedido["ID pedido"];

            contenedor.replaceChildren(
                botonInfo,
                botonConfirmar,
                botonEliminar,
            );
            pedido["acciones"] = contenedor;
            const tr = document.createElement("tr");

            const tds = Object.keys(pedido).map((campo) => {
                const td = document.createElement("td");

                if (campo == "acciones") {
                    td.appendChild(pedido[campo]);
                } else {
                    td.innerHTML = pedido[campo];
                }

                if (!campos.includes(campo)) {
                    campos.push(campo);
                }

                td.classList.add("text-center");

                return td;
            });

            tr.replaceChildren(...tds);
            tr.id = "pedido-" + pedido["ID pedido"];

            return tr;
        });

        tbody.replaceChildren(...rows);

        const thead = document.createElement("thead");
        const trHead = document.createElement("tr");

        const ths = campos.map((campo) => {
            const th = document.createElement("th");
            th.innerHTML = campo;

            return th;
        });

        trHead.replaceChildren(...ths);
        thead.appendChild(trHead);

        table.appendChild(thead);
        table.appendChild(tbody);

        return table;
    },

    crearItemModal: (pedido) => {
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

        // const icon = document.createElement("i");
        // icon.classList.add("quitar-item", "fa-solid", "fa-xmark", "ms-0");
        // icon.id = pedido.id;

        divPrecioSpan.replaceChildren(span);

        div.replaceChildren(h6, small);
        li.replaceChildren(div, divPrecioSpan);

        return li;
    },
};
