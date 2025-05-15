export const dom = {
    crearOpcionCategoria: (id, categoria) => {
        const opt = document.createElement("option");
        opt.value = id;
        opt.textContent = categoria;

        return opt;
    },
    crearTablaProducto: (campo, valor) => {
        const tr = document.createElement("tr");

        const th = document.createElement("th");
        th.textContent = campo;

        const td = document.createElement("td");
        td.textContent = valor;

        tr.replaceChildren(th, td);

        return tr;
    },
    crearTabla: (productos) => {
        const table = document.createElement("table");
        table.id = "productos";
        table.classList.add(
            "table",
            "align-middle",
            "table-hover",
            "table-borderless",
            "table-striped",
        );

        const tbody = document.createElement("tbody");
        const campos = [];

        const rows = productos.map((producto) => {
            delete producto.imagen;
            const tr = document.createElement("tr");

            const tds = Object.keys(producto).map((campo) => {
                const td = document.createElement("td");
                td.textContent = producto[campo];

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
            th.textContent = campo;

            return th;
        });

        trHead.replaceChildren(...ths);
        thead.appendChild(trHead);

        table.appendChild(thead);
        table.appendChild(tbody);

        return table;
    },
    cardProducto: (id, nombre, descripcion, precio, imagen) => {
        const divCol = document.createElement("div");
        // Uso de clases Bootstrap para responsividad
        divCol.className = "col-6 col-md-4 col-lg-3 mb-4";
        divCol.id = id;
        divCol.innerHTML = `
        <div class="card h-100 shadow-sm">
            <div class="position-relative">
                <img src="../${imagen}" class="card-img-top w-100 object-fit-cover" alt="Imagen del producto ${nombre}">
                <span class="position-absolute top-0 start-0 badge bg-primary rounded-pill m-2">${precio}</span>
                <div class="position-absolute top-0 end-0 m-2">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light rounded-circle" type="button" id="dropdownMenuButton-${id}" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton-${id}">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-heart"></i> Añadir a favoritos</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-share-alt"></i> Compartir producto</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-box"></i> Ver disponibilidad</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-flag"></i> Reportar problema</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body d-flex flex-column p-3">
                <h5 class="card-title text-truncate">${nombre}</h5>
                <small class="text-muted mb-2 d-block">Precio: ${precio}</small>
                <div class="d-flex  gap-1 justify-content-between mt-auto">
                    <button class="btn btn-ssm btn-primary" type="button" id-producto="${id}" data-bs-toggle="modal" data-bs-target="#modal-info" >
                        <i class="fas fa-info-circle"></i> Info
                    </button>
                    <button class="btn btn-ssm btn-warning editar" type="button" data-bs-toggle="modal" data-bs-target="#modal-editar" id-producto="${id}">
                        <i class="fas fa-pencil-alt"></i> Editar
                    </button>
                    <button class="btn btn-ssm btn-danger eliminar" type="button" id-producto="${id}">
                        <i class="fas fa-trash-alt"></i> Eliminar
                    </button>
                </div>
            </div>
        </div>
    `;
        return divCol;
    },
};
