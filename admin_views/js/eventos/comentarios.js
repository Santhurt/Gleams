import { responsive } from "./responsive.js";
import { dataComentarios } from "../ajax/data_comentarios.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";
import { dom } from "../componentes/comentarios_componentes.js";

export async function renderComentarios() {
    responsive();

    const contenedorComentarios = document.querySelector(
        "#contenedor-comentarios",
    );

    const respuesta = await dataComentarios.traerComentarios();
    console.log(respuesta);

    if (respuesta.status != 200) {
        swal.fire({
            title: "Error",
            text: respuesta.mensaje,
            icon: "error",
            confirmButtonText: "Continuar",
            customClass: {
                confirmButton: "btn btn-primary",
            },
        });

        return;
    }

    const comentarios = respuesta.datos;
    const tabla = dom.crearTabla(comentarios);

    contenedorComentarios.appendChild(tabla);

    new DataTable("#comentarios", {
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

    contenedorComentarios.addEventListener("click", (e) => {
        const boton = e.target;

        if (boton.classList.contains("eliminar")) {
            const idComentario = boton.id;

            swal.fire({
                title: "Aviso",
                text: "¿Eliminar comentario?",
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonText: "Aceptar",
                customClass: {
                    confirmButton: "btn btn-info",
                    cancelButton: "btn btn-danger",
                },
            }).then(async (res) => {
                if (res.isConfirmed) {
                    const respuesta =
                        await dataComentarios.eliminarComentario(idComentario);

                    if (respuesta.status == 200) {
                        swal.fire({
                            title: respuesta.mensaje,
                            icon: "success",
                            confirmButtonText: "Continuar",
                            customClass: {
                                confirmButton: "btn btn-info",
                            },
                        }).then(()=>{
                            const tr = boton.closest("tr");
                            tr.parentElement.removeChild(tr);
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
}
