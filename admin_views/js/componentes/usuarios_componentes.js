export const dom = {
    crearTabla: (usuarios) => {
        const table = document.createElement("table");
        table.id = "usuarios";
        table.classList.add(
            "table",
            "align-middle",
            "table-hover",
            "table-borderless",
            "table-striped",
        );

        const tbody = document.createElement("tbody");
        const campos = [];

        const rows = usuarios.map((usuario) => {
            const contenedor = document.createElement("div");
            contenedor.classList.add("d-flex", "gap-2");

            const botonEditar = document.createElement("button");
            botonEditar.innerHTML = `<i class="fas fa-pencil-alt"></i> Editar`;
            botonEditar.classList.add("btn", "btn-warning");
            botonEditar.id = usuario["ID Usuario"];
            botonEditar.setAttribute("data-bs-toggle", "modal");
            botonEditar.setAttribute("data-bs-target", "#modal-editar");

            const botonEliminar = document.createElement("button");
            botonEliminar.innerHTML = `<i class="fas fa-trash-alt"></i> Eliminar`;
            botonEliminar.classList.add("btn", "btn-danger", "eliminar");
            botonEliminar.id = usuario["ID Usuario"];

            contenedor.replaceChildren(botonEditar, botonEliminar);
            usuario["acciones"] = contenedor;
            const tr = document.createElement("tr");

            const tds = Object.keys(usuario).map((campo) => {
                const td = document.createElement("td");
                if (campo == "acciones") {
                    td.appendChild(usuario[campo]);
                } else {
                    td.innerHTML = usuario[campo];
                }

                if (!campos.includes(campo)) {
                    campos.push(campo);
                }

                return td;
            });

            tr.replaceChildren(...tds);

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
};
