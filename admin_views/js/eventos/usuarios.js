import { data } from "../ajax/data_usuarios.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";
import { dom } from "../componentes/usuarios_componentes.js"; //enrealidad solo es para traer la funcion de tabla

export async function renderUsuarios() {
    const contenedorUsuarios = document.querySelector("#contenedor-usuarios");

    const usuarios = await data.traerUsuarios();

    if (usuarios.status == 500) {
        swal.fire({
            title: "Error",
            text: usuarios.mensaje,
            icon: "error",
            confirmButtonText: "Continuar",
        });

        return;
    }

    const tabla = dom.crearTabla(usuarios);
    contenedorUsuarios.appendChild(tabla);

    new DataTable("#usuarios", {
        responsive: true,
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

    contenedorUsuarios.addEventListener("click", (e) => {
        const boton = e.target;

        if (boton.classList.contains("eliminar")) {
            const idUsuario = boton.id;
            swal.fire({
                title: "Aviso",
                text: "¿Esta seguro de que quiere eliminar el producto?",
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonText: "Aceptar",
                customClass: {
                    confirmButton: "btn btn-info",
                    cancelButton: "btn btn-danger",
                },
            }).then(async (respuesta) => {
                if (respuesta.isConfirmed) {
                    const respuesta = await data.eliminarUsuario(idUsuario);

                    if (respuesta.status == 200) {
                        swal.fire({
                            title: "Tarea completa",
                            text: "El usuario fue eliminado con exito",
                            icon: "success",
                            confirmButtonText: "Continuar",
                            customClass: {
                                confirmButton: "btn btn-info",
                            },
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
