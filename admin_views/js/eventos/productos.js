import { data } from "../ajax/data-productos.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";
import { dom } from "../componentes/productos_componentes.js";

export async function renderProductos() {
    // -------------------- carga de categorias ---------------------------
    const selectCategoria = document.querySelector("#select-categoria");
    const selectCategoriaModal = document.querySelector("#select-modal");

    const datos = await data.traerCategorias();

    if (datos.status == 500) {
        swal.fire({
            title: "Error",
            text: datos.mensaje,
            icon: "error",
            confirmButtonText: "Continuar",
            customClass: {
                confirmButton: "btn btn-info",
            },
        });

        return;
    }

    const opciones = datos.categorias.map((categoria) => {
        return dom.crearOpcionCategoria(
            categoria.id_categoria,
            categoria.nombre,
        );
    });

    const opcionesModal = datos.categorias.map((categoria) => {
        return dom.crearOpcionCategoria(
            categoria.id_categoria,
            categoria.nombre,
        );
    });

    selectCategoria.replaceChildren(...opciones);
    selectCategoriaModal.replaceChildren(...opcionesModal);

    // --------------  carga de productos --------------------------

    const productos = await data.traerProductos();
    const contenedorProductos = document.querySelector("#contenedor-productos");
    console.log(productos);

    const cardsProductos = productos.map((producto) => {
        return dom.cardProducto(
            producto.id_producto,
            producto.producto,
            producto.descripcion,
            producto.precio,
            producto.imagen.ruta,
        );
    });

    contenedorProductos.replaceChildren(...cardsProductos);

    // -----------------evento del formulario-----------------------

    const formulario = document.querySelector("#formulario");

    formulario.addEventListener("submit", async (e) => {
        e.preventDefault();
        const producto = new FormData(formulario);

        const productoInsertado = await data.insertarProducto(producto);

        if (productoInsertado.ok) {
            swal.fire({
                title: "Tarea completa",
                text: "El producto fue creado con exito",
                icon: "success",
                confirmButtonText: "Continuar",
                customClass: {
                    confirmButton: "btn btn-info",
                },
            }).then((resultado) => {
                if (resultado.isConfirmed) {
                    const nuevoProducto = dom.cardProducto(
                        productoInsertado.id,
                        productoInsertado.nombre,
                        productoInsertado.descripcion,
                        productoInsertado.precio,
                        productoInsertado.imagen,
                    );

                    contenedorProductos.appendChild(nuevoProducto);
                }
            });
        } else {
            swal.fire({
                title: "Error",
                text: productoInsertado.error.mensaje,
                icon: "error",
                confirmButtonText: "Continuar",
                customClass: {
                    confirmButton: "btn btn-info",
                },
            });
        }
    });

    //----------eventos de los botones-------------------------

    contenedorProductos.addEventListener("click", (e) => {
        const boton = e.target;
        console.log("click activado")
        console.log(e.target);

        if (boton.classList.contains("eliminar")) {
            const idProducto = boton.getAttribute("id-producto");

            swal.fire({
                title: "Aviso",
                text: "¿Esta seguro de que quiere eliminar el producto?",
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonText: "Aceptar",
                customClass: {
                    confirmButton: "btn btn-info",
                    cancelButton: "btn btn-danger",
                },
            })
                .then(async (resultado) => {
                    if (resultado.isConfirmed) {
                        const respuesta =
                            await data.eliminarProducto(idProducto);

                        if (respuesta.status == 200) {
                            return swal.fire({
                                title: "Producto eliminado",
                                icon: "success",
                                confirmButtonText: "Continuar",
                                customClass: {
                                    confirmButton: "btn btn-info",
                                },
                            });
                        } else {
                            return swal.fire({
                                title: "Error",
                                text: respuesta.mensaje,
                                icon: "error",
                                confirmButtonText: "Continuar",
                                customClass: {
                                    confirmButton: "btn btn-info",
                                },
                            });
                        }
                    }

                    return null;
                })
                .then((respuesta) => {
                    if (respuesta && respuesta.isConfirmed) {
                        //para eliminar el producto de la pagina
                        const cardProducto = document.getElementById(
                            `${idProducto}`,
                        );

                        cardProducto.parentNode.removeChild(cardProducto);
                    }
                });
        }
    });

    //--------------evento del modal de edicion----------------------
    //
    const modalEdicion = document.querySelector("#modal-editar");
    const modalInstancia = new bootstrap.Modal(modalEdicion);

    const formEditar = document.querySelector("#form-editar");

    modalEdicion.addEventListener("show.bs.modal", async (e) => {
        const boton = e.relatedTarget;
        const id = boton.getAttribute("id-producto");
        formEditar.setAttribute("id-producto", id);
        //const formEditar = document.querySelector("#form-editar");

        //para cargar los inputs
        const campos = [
            "nombre",
            "descripcion",
            "precio",
            "stock",
            "categoria",
            "imagen",
        ];
        const inputs = {};

        campos.forEach((campo) => {
            inputs[campo] = formEditar.querySelector(`[name="${campo}"]`);
        });

        const producto = await data.traerProductoPorId(id);

        console.log(producto);

        inputs.nombre.value = producto.producto;
        inputs.descripcion.value = producto.descripcion;
        inputs.precio.value = producto.precio;
        inputs.stock.value = producto.stock;

        inputs.categoria.childNodes.forEach((opcion) => {
            if (opcion.value == producto.categoria) {
                opcion.selected = true;
            }
        });
    });


    // form de editar

    formEditar.addEventListener("submit", async (e) => {
        e.preventDefault();
        const nuevoProducto = new FormData(formEditar);
        nuevoProducto.append("id", e.target.getAttribute("id-producto"));

        swal.fire({
            title: "Aviso",
            text: "¿Esta seguro de que quiere editar el producto?",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonText: "Aceptar",
            customClass: {
                confirmButton: "btn btn-info",
                cancelButton: "btn btn-danger",
            },
        }).then(async (respuesta) => {
            if (respuesta.isConfirmed) {
                const productoEditado =
                    await data.editarProducto(nuevoProducto);
                console.log(productoEditado);

                if (productoEditado.ok) {
                    swal.fire({
                        title: "Producto editado",
                        icon: "success",
                        confirmButtonText: "Continuar",
                        customClass: {
                            confirmButton: "btn btn-info",
                        },
                    }).then((resultado) => {
                        modalInstancia.hide();

                        const cardAntiguo = document.getElementById(
                            productoEditado.id,
                        );
                        const cardNueva = dom.cardProducto(
                            productoEditado.id,
                            productoEditado.nombre,
                            productoEditado.descripcion,
                            productoEditado.precio,
                            productoEditado.imagen,
                        );

                        contenedorProductos.replaceChild(
                            cardNueva,
                            cardAntiguo,
                        );
                    });
                } else {
                    swal.fire({
                        title: "Error",
                        text: productoEditado.mensaje,
                        icon: "error",
                        confirmButtonText: "Continuar",
                        customClass: {
                            confirmButton: "btn btn-info",
                        },
                    });
                }
            }
        });
    });

    // modal de informacion

    const modalInfo = document.querySelector("#modal-info");

    modalInfo.addEventListener("show.bs.modal", async (e) => {
        const boton = e.relatedTarget;
        const id = boton.getAttribute("id-producto");
        const tbody = document.querySelector("#tb-info");

        const producto = await data.traerProductoPorId(id);

        const respuestaCategorias = await data.traerCategorias();
        const categorias = respuestaCategorias.categorias;

        console.log(categorias);

        const rows = Object.keys(producto).map((campo) => {
            if (campo == "categoria") {
                categorias.forEach((categoria) => {
                    if (categoria.id_categoria == producto[campo]) {
                        producto[campo] = categoria.nombre;
                    }
                });
            }

            if (campo == "estado") {
                producto[campo] =
                    producto[campo] == 1 ? "Disponible" : "No disponible";
            }

            return dom.crearTablaProducto(campo, producto[campo]);
        });

        tbody.replaceChildren(...rows);
    });
}
