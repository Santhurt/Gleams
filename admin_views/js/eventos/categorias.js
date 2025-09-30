import { dataProductos } from "../ajax/data-productos.js";

export function categorias() {
    document.querySelector("#abrir-categorias").addEventListener("click", async () => {
        const respuesta = await dataProductos.traerCategorias();
        console.log(respuesta);

        if(respuesta.status != 200) {
            console.log("No se pudieron traer las categorias");
            return;
        }

        const categorias = respuesta.data;
        
    });
}
