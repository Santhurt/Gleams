import { responsive } from "./responsive.js";
import { dom } from "../componentes/pedidos_componentes.js";
import { data } from "../ajax/data_pedidos.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";

export async function renderPedidos() {
    responsive();

    const respuesta = await data.traerPedidos();
    console.log(respuesta);

    if (respuesta.status != 200) {
        swal.fire({
            title: "Error",
            text: usuarios.mensaje,
            icon: "error",
            confirmButtonText: "Continuar",
        });

        return;
    }

    const contenedorPedidos = document.querySelector("#contenedor-pedidos");
    const tabla = dom.crearTabla(respuesta.datos);

    contenedorPedidos.appendChild(tabla);

    new DataTable("#pedidos", {
        responsive: {
            details: {
                type: "column",
                target: "tr",
            },
        },
        columnDefs: [
            {
                className: "dt-control",
                orderable: false,
                targets: 0,
            },
        ],
        language: {
            search: "Buscar",
            lengthMenu: "_MENU_ registros",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            zeroRecords: "No se encontraron resultados",
            emptyTable: "No hay datos disponibles en la tabla",
        },
    });

    //cancelacion de pedidos--------------------------------------------

    contenedorPedidos.addEventListener("click", (e) => {
        const boton = e.target;
        let accion = "";
        let mensaje = "";
        let titulo = "";

        if (boton.classList.contains("eliminar")) {
            accion = "cancelado";
            mensaje = "Esta seguro de que quiere cancelar el pedido?";
            titulo = "Pedido cancelado";
        } else if (boton.classList.contains("confirmar")) {
            accion = "entregado";
            mensaje =
                "Esta seguro de que quiere marcar como entregado el pedido?";
            titulo = "Entrega del pedido confirmada";
        }

        if (
            boton.classList.contains("eliminar") ||
            boton.classList.contains("confirmar")
        ) {
            const idPedido = boton.id;

            swal.fire({
                title: "Aviso",
                text: mensaje,
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonText: "Aceptar",
                customClass: {
                    confirmButton: "btn btn-info",
                    cancelButton: "btn btn-danger",
                },
            }).then(async (respuestaAlert) => {
                if (respuestaAlert.isConfirmed) {
                    const respuesta = await data.cambiarEstado(
                        idPedido,
                        accion,
                    );
                    if (respuesta.status == 200) {
                        swal.fire({
                            title: titulo,
                            icon: "success",
                            confirmButtonText: "Continuar",
                            customClass: {
                                confirmButton: "btn btn-info",
                            },
                        }).then(() => {
                            const tr = boton.closest("tr");
                            const pedidoActualizado = respuesta.datos;

                            const nuevaTr = dom.crearRow(pedidoActualizado);
                            tr.parentElement.replaceChild(nuevaTr, tr);
                        });
                    } else {
                        swal.fire({
                            title: "Error",
                            text: respuesta.mensaje,
                            icon: "error",
                            confirmButtonText: "Continuar",
                            customClass: {
                                confirmButton: "btn btn-info",
                            },
                        });
                    }
                }
            });
        }
    });

    // modal de informacion ----------------------------------------

    const modalInfo = document.querySelector("#modal-info");
    const itemsInfo = document.querySelector("#items-info");

    modalInfo.addEventListener("show.bs.modal", async (e) => {
        const boton = e.relatedTarget;
        const idPedido = boton.id;

        const respuesta = await data.traerDetallesPedidos(idPedido);
        const pedidos = respuesta.status == 200 ? respuesta.datos : [];
        console.log(pedidos);

        const rows = pedidos.map((pedido) => {
            return dom.crearItemModal(pedido);
        });

        itemsInfo.replaceChildren(...rows);
    });
}
