import { dataPedido } from "../ajax/data_pedidos.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";
import { domPedidos } from "../componentes/pedidos_componentes.js";
import { renderCarrito } from "./carrito.js";
import { cargarProductos } from "./cargar_productos.js";
import { dom } from "../componentes/shop_componentes.js";

export async function renderPedidos() {
    cargarProductos();

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
    const elementosTransicion = document.querySelectorAll(".fade-in");
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

    const respuesta = await dataPedido.traerPedidosCliente();

    const mensajeDisponible = document.querySelector("#mensaje");
    const mensajePendientes = document.querySelector("#mensaje-pendientes");
    const mensajeEntregados = document.querySelector("#mensaje-entregados");

    if (respuesta.status != 200) {
        mensajeDisponible.style.display = "block";
        Toast.fire({
            title: "Error al traer los pedidos",
            icon: "error",
        });
    }

    const pedidos = respuesta.datos;

    if (pedidos.length > 0) {
        mensajeDisponible.style.display = "none";
    }

    const contenedorPendientes = document.querySelector(
        "#contenedor-pendientes",
    );
    const contenedorEntregados = document.querySelector(
        "#contenedor-entregados",
    );

    //pendientes
    const pendientes = pedidos.filter(
        (pedido) => pedido.estado === "pendiente",
    );

    //entregados
    const entregados = pedidos.filter(
        (pedido) => pedido.estado === "entregado",
    );

    if (pendientes.length > 0) {
        const itemsPedidos = pendientes.map((pedido) => {
            return domPedidos.crearPedido(pedido);
        });

        contenedorPendientes.replaceChildren(...itemsPedidos);
    } else {
        mensajePendientes.style.display = "block"
    }

    if (entregados.length > 0) {
        const itemsPedidos = entregados.map((pedido) => {
            return domPedidos.crearPedido(pedido);
        });

        contenedorEntregados.replaceChildren(...itemsPedidos);
    } else {
        mensajeEntregados.style.display = "block";
    }

    const modal = document.querySelector("#mostrarDetalle");

    modal.addEventListener("show.bs.modal", async (e) => {
        const boton = e.relatedTarget;
        const idPedido = boton.id;

        const respuesta = await dataPedido.traerDetalles(idPedido);
        console.log(respuesta);

        if (respuesta.status != 200) {
            Toast.fire({
                title: respuesta.mensaje,
                icon: "error",
            });
            return;
        }

        const detalles = respuesta.datos;

        const itemsModal = detalles.map((detalle) => {
            return domPedidos.crearItemModal(
                detalle.nombre,
                detalle.cantidad,
                detalle.precio_unitario,
            );
        });

        const contenedorDetalles = modal.querySelector("#contenedor-detalles");
        contenedorDetalles.replaceChildren(...itemsModal);
    });

    contenedorPendientes.addEventListener("click", (e) => {
        const boton = e.target;

        if (boton.classList.contains("eliminar")) {
            const idPedido = boton.id;

            swal.fire({
                title: "¿Cancelar pedido?",
                showCancelButton: true,
                confirmButtonText: "Si",
                cancelButtonText: "Volver",
                customClass: {
                    title: "poppins-light",
                    confirmButton: "poppins-light boton-fondo-morado",
                    cancelButton: "poppins-light boton-fondo-blanco",
                },
            }).then(async (respuesta) => {
                if (respuesta.isConfirmed) {
                    const respuesta = await dataPedido.cancelarPedido(idPedido);

                    if(respuesta.status == 200) {
                        const item = boton.closest(`#item-${idPedido}`);
                        item.parentElement.removeChild(item);

                        Toast.fire({
                            title: "Pedido cancelado",
                            icon: "success"
                        });
                    } else {
                        Toast.fire({
                            title: "Error al cancelar el pedido",
                            icon: "error"
                        });
                    }
                }
            });
        }
    });

    renderCarrito();
    dom.actualizarContadorCarrito();
}
