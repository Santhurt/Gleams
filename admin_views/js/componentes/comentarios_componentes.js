export const dom = {
    crearTabla: (comentarios) => {
        const table = document.createElement("table");
        table.id = "comentarios";
        table.classList.add(
            "table",
            "align-middle",
            "table-hover",
            "table-borderless",
            "table-striped",
        );

        const tbody = document.createElement("tbody");
        tbody.id = "t-comentarios";
        const campos = [];

        const rows = comentarios.map((comentario) => {
            const contenedor = document.createElement("div");
            contenedor.classList.add("d-flex", "gap-2");

            const botonEliminar = document.createElement("button");
            botonEliminar.innerHTML = `<i id="${comentario["ID comentario"]}" class="fas fa-trash-alt eliminar"></i>`;
            botonEliminar.classList.add("btn", "btn-danger", "eliminar");
            botonEliminar.id = comentario["ID comentario"];

            contenedor.replaceChildren(
                botonEliminar,
            );
            comentario["acciones"] = contenedor;
            const tr = document.createElement("tr");

            const tds = Object.keys(comentario).map((campo) => {
                const td = document.createElement("td");

                if (campo == "acciones") {
                    td.appendChild(comentario[campo]);
                } else {
                    td.innerHTML = comentario[campo];
                }

                if (!campos.includes(campo)) {
                    campos.push(campo);
                }

                td.classList.add("text-center");

                return td;
            });

            tr.replaceChildren(...tds);
            tr.id = "comentario-" + comentario["ID comentario"];

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
}
