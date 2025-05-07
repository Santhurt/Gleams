import { data } from "../data.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";

export async function renderProductos() {
    new DataTable("#example", {
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

    let tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]'),
    );

    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    const formulario = document.querySelector("#formulario");

    formulario.addEventListener("submit", async (e) => {
        e.preventDefault();
        const producto = new FormData(formulario);

        console.log(producto);

        const respuesta = await data.insertarProducto(producto);

        if (respuesta.status == 200) {
            swal.fire({
                title: "Tarea exitosa",
                text: "El empleado fue creado con exito",
                icon: "success",
            });
        } else if(respuesta.camposVacios) {
            swal.fire({
                title: "Error",
                text:`Hacen falta los siguientes campos: ${respuesta.mensaje.join(", ")}`,
                icon: "error",
            });
        } else if (respuesta.numerosInvalidos){
            swal.fire({
                title: "Error",
                text:respuesta.mensaje,
                icon: "error",
            });

        }
    });
}
