import { data } from "../ajax/data-productos.js";
import { dom } from "../componentes/productos_componentes.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";
import { responsive } from "./responsive.js";

export async function renderListado() {
    responsive();
    //----- carga de productos ------------

    const contenedorProductos = document.querySelector("#contenedor-productos");

    const productos = await data.traerProductos();
    console.log(productos);

    if (productos.status == 500) {
        swal.fire({
            title: "Error",
            text: productos.mensaje,
            icon: "error",
            confirmButtonText: "Continuar",
            customClass: {
                confirmButton: "btn btn-primary",
            },
        });

        return;
    }
    const tabla = dom.crearTabla(productos);
    contenedorProductos.appendChild(tabla);

    new DataTable("#productos", {
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
}
