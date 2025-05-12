import { data } from "../ajax/data-productos.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";
import { dom } from "../componentes/productos_componentes.js";

export async function renderProductos() {
    // -------------------- carga de categorias ---------------------------
    const selectCategoria = document.querySelector("#select-categoria");
    const datos = await data.traerCategorias();

    if (datos.status == 500) {
        swal.fire({
            title: "Error",
            text: datos.mensaje,
            icon: "error",
        });

        return;
    }

    const opciones = datos.categorias.map((categoria) => {
        return dom.crearOpcionCategoria(
            categoria.id_categoria,
            categoria.nombre,
        );
    });

    selectCategoria.replaceChildren(...opciones);

    // --------------  carga de productos --------------------------

    const productos = await data.traerProductos();
    const contenedorProductos = document.querySelector("#contenedor-productos");
    console.log(productos);

    const cardsProductos = productos.map((producto) => {
        return dom.cardProducto(
            producto.imagen.ruta,
            producto.precio,
            producto.producto,
            producto.descripcion,
            producto.id_producto,
        );
    });

    contenedorProductos.replaceChildren(...cardsProductos);

    // -----------------evento del formulario-----------------------

    const formulario = document.querySelector("#formulario");

    formulario.addEventListener("submit", async (e) => {
        e.preventDefault();
        const producto = new FormData(formulario);

        console.log(producto);

        const respuesta = await data.insertarProducto(producto);
        //nota: seria mejor idea que el metodo post devuelva
        //directamente toda la imagen
        //asi nos evitamos problemas al eliminar

        if (respuesta.status == 200) {
            // no me sirve por que necesito la imagen xd
            swal.fire({
                title: "Tarea exitosa",
                text: "El empleado fue creado con exito",
                icon: "success",
            }).then((resultado) => {
                if (resultado.isConfirmed) {
                    const nuevoProducto = dom.cardProducto(
                        respuesta.imagen_producto,
                        producto.get("precio"),
                        producto.get("nombre"),
                        producto.get("descripcion"),
                    );

                    contenedorProductos.appendChild(nuevoProducto);
                }
            });
        } else {
            swal.fire({
                title: "Error",
                text: respuesta.mensaje,
                icon: "error",
            });
        }
    });

    //eventos de los botones

    contenedorProductos.addEventListener("click", (e) => {
        console.log(e.target);
        const boton = e.target;

        if (boton.classList.contains("eliminar")) {
            const idProducto = boton.getAttribute("id-producto");

            swal.fire({
                title: "Aviso",
                text: "¿Esta seguro de que quiere eliminar el producto?",
                icon: "warning",
            })
                .then(async (resultado) => {
                    if (resultado.isConfirmed) {
                        const respuesta =
                            await data.eliminarProducto(idProducto);

                        if (respuesta.status == 200) {
                            return swal.fire({
                                title: "Tarea completa",
                                text: respuesta.mensaje,
                                icon: "success",
                            });
                        } else {
                            return swal.fire({
                                title: "Error",
                                text: respuesta.mensaje,
                                icon: "error",
                            });
                        }
                    }
                })
                .then((respuesta) => {
                    if (respuesta.isConfirmed) {
                        //para eliminar el producto de la pagina
                        const cardProducto = document.getElementById(
                            `${idProducto}`,
                        );

                        cardProducto.parentNode.removeChild(cardProducto);
                    }
                });
        }
    });
}
