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
}
