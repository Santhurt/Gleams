<div class="modal fade" id="modal-categorias" tabindex="-1" aria-labelledby="minimalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Crear nueva categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <form id="form-descuento">
                    <input type="hidden" id="hidden-descuento" name="id-producto">

                    <div class="mb-3 d-flex flex-grow-1 align-items-center gap-2">
                        <label for="input-nombre" class="label-form">Nombre: </label>
                        <input type="text" id="input-nombre" name="nombre" class="form-control">

                        <button type="button" id="crear-categoria" class="btn btn-success">+</button>
                    </div>

                </form>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Nombre de la Categoría 1
                        <div class="btn-group btn-group-sm" role="group" aria-label="Acciones de Categoría">
                            <button type="button" class="btn btn-primary">Editar</button>
                            <button type="button" class="btn btn-danger">Eliminar</button>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Nombre de la Categoría 2
                        <div class="btn-group btn-group-sm" role="group" aria-label="Acciones de Categoría">
                            <button type="button" class="btn btn-primary">Editar</button>
                            <button type="button" class="btn btn-danger">Eliminar</button>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="submit" form="form-descuento" class="btn btn-success" data-bs-dismiss="modal">Aplicar descuento</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
