import { dataProductos } from "../ajax/data_productos.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";
import { renderCarrito } from "./carrito.js";
import { dom } from "../componentes/shop_componentes.js";
import { dataPedido } from "../ajax/data_pedidos.js";

export async function renderizarProducto() {
    const elementosTransicion = document.querySelectorAll(".fade-in");
    // configuracion pal toast
    const Toast = swal.mixin({
        toast: true,
        position: "top-end",
        iconColor: "white",
        customClass: {
            popup: "colored-toast",
        },
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
    });

    const observer = new IntersectionObserver(
        (observados) => {
            observados.forEach((observado, i) => {
                if (observado.isIntersecting) {
                    const elementoVisible = observado.target;
                    elementoVisible.style.transitionDelay = `${i * 0.2}s`;
                    elementoVisible.classList.add("show");

                    observer.unobserve(observado.target);
                }
            });
        },
        { threshold: 0.2 },
    );

    elementosTransicion.forEach((elemento) => {
        observer.observe(elemento);
    });

    const infoProducto = {
        imagen: document.querySelector("#imagen"),
        titulo: document.querySelector("#titulo"),
        precio: document.querySelector("#precio"),
        descripcion: document.querySelector("#descripcion-texto"),
        cantidad: document.querySelector("#input-cantidad"),
    };

    const botonesCantidad = document.querySelectorAll(".btn-cantidad");
    botonesCantidad.forEach((boton) => {
        boton.addEventListener("click", (e) => {
            if (e.target.dataset.op == "agregar") {
                infoProducto.cantidad.value++;
            } else if (
                e.target.dataset.op == "restar" &&
                infoProducto.cantidad.value > 1
            ) {
                infoProducto.cantidad.value--;
            }
        });
    });

    const idLabel = document.querySelector("#producto-hidden");
    const idProducto = idLabel.getAttribute("id-producto");
    const respuesta = await dataProductos.traerProducto(idProducto);
    console.log(respuesta);

    if (respuesta.status != 200) {
        Toast.fire({
            title: respuesta.mensaje,
            icon: "error",
        });
        return;
    }

    //------------renderizado de comentarios

    const respuestaComentarios =
        await dataProductos.traerComentarioProducto(idProducto);

    if (respuestaComentarios.status != 200) {
        Toast.fire({
            title: respuesta.mensaje,
            icon: "error",
        });
        return;
    }

    const comentariosContenedor = document.querySelector("#comentarios");
    const comentarios = respuestaComentarios.datos;

    const cardsComentarios = comentarios.map((comentario) => {
        return dom.crearComentario(comentario);
    });

    comentariosContenedor.replaceChildren(...cardsComentarios);

    const producto = respuesta.datos;
    infoProducto.imagen.src = "../" + producto.ruta;
    infoProducto.titulo.textContent = producto.producto;
    infoProducto.precio.textContent =
        producto.descuento != 0
            ? `$${producto.precio * (1 - producto.descuento / 100)}`
            : `$${producto.precio}`;
    infoProducto.descripcion.textContent = producto.descripcion;

    const contenedorBotones = document.querySelector("#contenedor-botones");
    contenedorBotones.addEventListener("click", async (e) => {
        if (e.target.classList.contains("agregar")) {
            const pedido = {
                id: idProducto,
                nombre: producto.producto,
                precio: producto.precio * (1 - (producto.descuento / 100)),
                cantidad:
                    parseInt(infoProducto.cantidad.value) > 0
                        ? parseInt(infoProducto.cantidad.value)
                        : 0,
            };

            // Verificar si el producto ya existe en el carrito
            const productoExistente = localStorage.getItem(idProducto);
            if (productoExistente) {
                const productoData = JSON.parse(productoExistente);
                productoData.cantidad += parseInt(infoProducto.cantidad.value);
                localStorage.setItem(idProducto, JSON.stringify(productoData));
            } else {
                localStorage.setItem(idProducto, JSON.stringify(pedido));
            }

            Toast.fire({
                title: "Producto agregado al carrito",
                icon: "success",
            });

            dom.actualizarContadorCarrito();
        } else if (e.target.classList.contains("comprar")) {
            // Es la misma logica de arriba pero refactorizar esta cosa
            // en una funcion no sirvio pa un culo
            const pedido = {
                id: idProducto,
                nombre: producto.producto,
                precio: producto.precio,
                cantidad:
                    parseInt(infoProducto.cantidad.value) > 0
                        ? infoProducto.cantidad.value
                        : 0,
            };

            const respuesta = await dataPedido.agregarAlCarrito(
                pedido.id,
                pedido.cantidad,
            );

            if (respuesta.status != 200) {
                Toast.fire({
                    title: respuesta.mensaje,
                    icon: "error",
                });
                return;
            }

            window.location.replace("pago.php");
        }
    });

    // También actualizar cuando se carga la página si ya hay items
    dom.actualizarContadorCarrito();

    // ---------------- renderizar en el carrito----------------------------

    renderCarrito();

    // ................ logica de los comentarios
    const comentario = document.querySelector("#form-comentario");

    comentario.addEventListener("submit", async (e) => {
        e.preventDefault();

        const comentarioData = new FormData(comentario);
        const respuesta = await dataProductos.crearComentario(comentarioData);

        if (respuesta.status == 200) {
            Toast.fire({
                title: "Comentario creado con exito",
                icon: "success",
            });

            // TODO: Mostrar el comentario una vez creado
        } else {
            Toast.fire({
                title: respuesta.mensaje,
                icon: "error",
            });
        }

        const comentarioInput = document.querySelector("#comentario");
        comentarioInput.value = "";
    });
}
