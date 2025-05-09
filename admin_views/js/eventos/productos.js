import { data } from "../ajax/data-productos.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";
import { dom } from "../componentes/productos_componentes.js";

export async function renderProductos() {
    const selectCategoria = document.querySelector("#select-categoria");
    const datos = await data.traerCategorias();

    const opciones = datos.categorias.map((categoria) => {
        return dom.crearOpcionCategoria(categoria.id_categoria, categoria.nombre);
    });

    selectCategoria.replaceChildren(...opciones);

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
        } else if(respuesta.imagenInvalida){
            swal.fire({
                title: "Error",
                text: respuesta.mensaje,
                icon: "error",
            });
        } else if (respuesta.status == 500) {
            swal.fire({
                title: "Error",
                text: respuesta.mensaje,
                icon: "error",
            });
        }
    });
}
