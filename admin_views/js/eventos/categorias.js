import { dataProductos } from "../ajax/data-productos.js";
import { dom } from "../componentes/productos_componentes.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";

export function categorias() {
    const listaCategorias = document.querySelector("#lista-categorias");

    async function cargarCategorias() {
        const respuesta = await dataProductos.traerCategorias();
        console.log(respuesta);

        if (respuesta.status != 200) {
            console.log("No se pudieron traer las categorias");
            return;
        }

        const categorias = respuesta.categorias;

        const itemsCategorias = categorias.map((categoria) => {
            return dom.crearItemCategoria(categoria);
        });

        listaCategorias.replaceChildren(...itemsCategorias);
    }

    document
        .querySelector("#abrir-categorias")
        .addEventListener("click", async () => {
            cargarCategorias();
        });

    // Crear categoria

    const formularioCategoria = document.querySelector("#form-categoria");

    formularioCategoria.addEventListener("submit", async (e) => {
        e.preventDefault();
        const nuevaCategoria = new FormData(formularioCategoria);
        const respuesta = await dataProductos.crearCategoria(nuevaCategoria);
        console.log(respuesta);

        if (respuesta.status != 200) {
            swal.fire({
                title: "Error",
                text: "No se pudo crear la categoria",
                icon: "error",
                confirmButtonText: "Continuar",
                customClass: {
                    confirmButton: "btn btn-primary",
                },
            });

            return;
        }

        cargarCategorias();
    });

    document
        .querySelector("#lista-categorias")
        .addEventListener("click", async (e) => {
            // 1. Verificar si el clic fue en el botón de "Editar" o "Guardar"
            const boton = e.target;
            if (
                boton.classList.contains("editar") ||
                boton.classList.contains("guardar")
            ) {
                // Obtener el <li> padre y el input asociado
                const listItem = boton.closest("li");
                const inputElement =
                    listItem.querySelector("input[type='text']");

                if (boton.classList.contains("editar")) {
                    //  MODO EDICIÓN

                    // Habilitar el input y enfocarlo
                    inputElement.disabled = false;
                    inputElement.focus();

                    // Cambiar el botón: "Editar" -> "Guardar"
                    boton.textContent = "Guardar";
                    boton.classList.remove("editar", "btn-primary");
                    boton.classList.add("guardar", "btn-success");

                    // Deshabilitar el botón de "Eliminar" temporalmente (opcional)
                    listItem.querySelector(".eliminar").disabled = true;
                } else if (boton.classList.contains("guardar")) {
                    //  MODO GUARDADO (Guardar Cambios)

                    // 1. Obtener la información para la petición
                    const idCategoria = boton.dataset.id;
                    const nuevoNombre = inputElement.value;

                    const nuevaCategoria = new FormData();
                    nuevaCategoria.set("nombre", nuevoNombre);
                    nuevaCategoria.set("id", idCategoria);

                    const respuesta =
                        await dataProductos.editarCategoria(nuevaCategoria);
                    console.log(respuesta);


                    volverAModoVisualizacion(listItem, inputElement, boton);
                }
            } else if(boton.classList.contains("eliminar")) {

            }
        });
    // Función para revertir el estado del item a modo de visualización
    function volverAModoVisualizacion(listItem, inputElement, botonGuardar) {
        // Deshabilitar el input
        inputElement.disabled = true;

        // Cambiar el botón: "Guardar" -> "Editar"
        botonGuardar.textContent = "Editar";
        botonGuardar.classList.remove("guardar", "btn-success");
        botonGuardar.classList.add("editar", "btn-primary");

        // Habilitar el botón de "Eliminar"
        const botonEliminar = listItem.querySelector(".eliminar");
        if (botonEliminar) {
            botonEliminar.disabled = false;
        }
    }
}
