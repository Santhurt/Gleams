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
        );
    });

    contenedorProductos.replaceChildren(...cardsProductos);

    // -----------------formulario-----------------------

    const formulario = document.querySelector("#formulario");

    formulario.addEventListener("submit", async (e) => {
        e.preventDefault();
        const producto = new FormData(formulario);

        console.log(producto);

        const respuesta = await data.insertarProducto(producto);

        if (respuesta.status == 200) {
            // no me sirve por que necesito la imagen xd
            swal.fire({
                title: "Tarea exitosa",
                text: "El empleado fue creado con exito",
                icon: "success",
            }).then((resultado) => {
                if (resultado.isConfirmed) {
                    const imagen = producto.get("imagen");
                    const nuevoProducto = dom.cardProducto(
                        `../assets/fotos/${imagen.name}`,
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
}
