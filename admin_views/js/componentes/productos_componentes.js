export const dom = {
    crearOpcionCategoria: (id, categoria) => {
        const opt = document.createElement("option");
        opt.value = id;
        opt.textContent = categoria;

        return opt;
    },

    cardProducto: (imagen, precio, titulo, descripcion, id) => {
        const divCol = document.createElement("div");
        divCol.className = "col-md-3";
        divCol.id = id;

        divCol.innerHTML = `
        <div class="card p-2" style="width: 18rem;">
            <div class="position-relative">
                <img src="../${imagen}" class="card-img-top" alt="Imagen del producto">
                <span class="position-absolute top-0 start-0 badge bg-primary rounded-pill m-2">$${precio}</span>

                <div class="position-absolute top-0 end-0 m-2">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light rounded-circle" type="button" id="dropdownMenuButton-${Date.now()}" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton-${Date.now()}">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-heart"></i> Añadir a favoritos</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-share-alt"></i> Compartir producto</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-box"></i> Ver disponibilidad</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-flag"></i> Reportar problema</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">${titulo}</h5>
                <p class="card-text">${descripcion}</p>
                <small class="text-muted mb-3 d-block">Precio: $${precio}</small>
                <div class="d-flex gap-2 mt-3 justify-content-center">
                    <button class="btn btn-sm btn-primary" type="button" id-producto="${id}">
                        <i class="fas fa-info-circle"></i> Info
                    </button>
                    <button class="btn btn-sm btn-warning" type="button" id-producto="${id}" >
                        <i class="fas fa-pencil-alt"></i> Editar
                    </button>
                    <button class="btn btn-sm btn-danger eliminar" type="button" id-producto="${id}">
                        <i class="fas fa-trash-alt"></i> Eliminar
                    </button>
                </div>
            </div>
        </div>
    `;

        return divCol;
    },
};
