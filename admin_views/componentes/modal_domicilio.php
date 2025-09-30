<?php
require_once __DIR__ . "/../../model/productos.php";

use modelos\Producto;

$producto = new Producto();
$monto = $producto->traer_domicilio();
?>
<div class="modal fade" id="modal-domicilio" tabindex="-1" aria-labelledby="minimalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Asignar domicilio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <form id="form-categoria">

                    <div class="d-flex justify-content-between align-items-center border p-2 mb-2 rounded bg-light">
                        <input type="text" class="form-control me-2" value="<?php echo $monto ?? 0; ?>" disabled>

                        <div class="btn-group btn-group-sm flex-shrink-0" role="group" aria-label="Acciones de domicilio">
                            <button type="button" class="btn editar btn-primary" id="editar-domicilio">Editar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
