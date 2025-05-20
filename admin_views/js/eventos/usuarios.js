import { data } from "../ajax/data_usuarios.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";
import { dom } from "../componentes/usuarios_componentes.js"; //enrealidad solo es para traer la funcion de tabla
import { responsive } from "./responsive.js";

export async function renderUsuarios() {
    responsive();

    const contenedorUsuarios = document.querySelector("#contenedor-usuarios");

    const usuarios = await data.traerUsuarios();
    console.log(usuarios);

    if (usuarios.status == 500 || usuarios.status == 401) {
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
            })
                .then(async (respuesta) => {
                    if (respuesta.isConfirmed) {
                        const respuesta = await data.eliminarUsuario(idUsuario);

                        if (respuesta.status == 200) {
                            swal.fire({
                                title: "Usuario eliminado",
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
                })
                .then((respuesta) => {
                    if (respuesta.isConfirmed) {
                        const tr = boton.closest("tr");
                        tr.parentElement.removeChild(tr);
                    }
                });
        }
    });

    // -------------------edicion de usuario ------------------

    const modalEditar = document.querySelector("#modal-editar");
    const modalInstancia = new bootstrap.Modal(modalEditar);
    const formEditar = document.querySelector("#form-editar");
    const tbodyUsuarios = document.querySelector("#t-usuarios");

    modalEditar.addEventListener("show.bs.modal", async (e) => {
        const boton = e.relatedTarget;
        const idUsuario = boton.id;

        formEditar.setAttribute("id-usuario", idUsuario);

        //para obtener los inputs
        const campos = [
            "nombre",
            "telefono",
            "fecha",
            "roles",
            "correo",
            "direccion",
        ];

        const inputs = {};

        campos.forEach((campo) => {
            inputs[campo] = document.querySelector(`[name="${campo}"]`);
        });

        const producto = await data.traerProductoPorId(idUsuario);
        console.log(producto);

        inputs.nombre.value = producto.nombre;
        inputs.telefono.value = producto.telefono;
        inputs.fecha.value = producto["fecha de registro"];
        inputs.correo.value = producto.correo;
        inputs.direccion.value = producto.direccion;

        const roles = await data.traerRoles();
        const optionsRoles = dom.crearOpcionRoles(roles);

        inputs.roles.replaceChildren(...optionsRoles);
    });

    formEditar.addEventListener("submit", async (e) => {
        e.preventDefault();
        const nuevoUsuario = new FormData(formEditar);
        nuevoUsuario.append("id", e.target.getAttribute("id-usuario"));

        swal.fire({
            title: "Aviso",
            text: "¿Esta seguro de que quiere editar el usuario?",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonText: "Aceptar",
            customClass: {
                confirmButton: "btn btn-info",
                cancelButton: "btn btn-danger",
            },
        }).then(async (resultado) => {
            if (resultado.isConfirmed) {
                const respuesta = await data.editarUsuario(nuevoUsuario);

                if (respuesta.status == 200) {
                    swal.fire({
                        title: "Producto editado",
                        icon: "success",
                        confirmButtonText: "Continuar",
                        customClass: {
                            confirmButton: "btn btn-info",
                        },
                    }).then(() => {
                        modalInstancia.hide();
                        const usuario = respuesta.usuarioEditado;
                        console.log(usuario);

                        const tr = document.querySelector(
                            `#usuario-${usuario.id}`,
                        );
                        const nuevaTr = dom.crearRow(usuario);

                        tbodyUsuarios.replaceChild(nuevaTr, tr);
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
    });
}
