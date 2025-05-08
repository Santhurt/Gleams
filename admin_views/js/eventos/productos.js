import { data } from "../data.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";

export async function renderProductos() {
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
        } else if (respuesta.camposVacios) {
            swal.fire({
                title: "Error",
                text: `Hacen falta los siguientes campos: ${respuesta.mensaje.join(", ")}`,
                icon: "error",
            });
        } else if (respuesta.numerosInvalidos) {
            swal.fire({
                title: "Error",
                text: respuesta.mensaje,
                icon: "error",
            });
        }
    });
}
