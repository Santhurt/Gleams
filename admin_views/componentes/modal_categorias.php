<div class="modal fade" id="modal-categorias" tabindex="-1" aria-labelledby="minimalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Crear nueva categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <form id="form-categoria">
                    <div class="mb-3 d-flex flex-grow-1 align-items-center gap-2">
                        <label for="input-nombre" class="label-form">Nombre: </label>
                        <input type="text" id="input-nombre" name="nombre" class="form-control">

                        <button type="submit" id="crear-categoria" class="btn btn-success">+</button>
                    </div>

                </form>
                <ul class="list-group" id="lista-categorias">
                    <!--Lista de categorias-->
                </ul>
            </div>
        </div>
    </div>
</div>
