import { data } from "../ajax/data-productos.js";
import { dom } from "../componentes/productos_componentes.js";

export async function renderListado() {
    //----- carga de productos ------------

    const contenedorProductos = document.querySelector("#contenedor-productos");

    const productos = await data.traerProductos();
    console.log(productos);

    const tabla = dom.crearTabla(productos);
    contenedorProductos.appendChild(tabla);

    new DataTable("#productos", {
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
}
