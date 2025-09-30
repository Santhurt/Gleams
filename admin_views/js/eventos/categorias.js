import { dataProductos } from "../ajax/data-productos.js";
import { dom } from "../componentes/productos_componentes.js";

export function categorias() {
    const listaCategorias = document.querySelector("#lista-categorias");

    document
        .querySelector("#abrir-categorias")
        .addEventListener("click", async () => {
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
        });
}
