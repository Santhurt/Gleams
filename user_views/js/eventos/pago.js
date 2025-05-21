import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";
import { dataPedido } from "../ajax/data_pedidos.js";
import { dom } from "../componentes/shop_componentes.js";
import { cargarProductos } from "./cargar_productos.js";

export async function renderPago() {
    cargarProductos(); 
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

    const contenedorPedidos = document.querySelector("#contenedor-pedidos");

    const respuesta = await dataPedido.traerPedidos();

    if (respuesta.status != 200) {
        swal.fire({
            title: "Error",
            text: respuesta.mensaje,
            icon: "error",
        });
        return;
    }

    const pedidos = respuesta.datos;
    console.log(pedidos);

    const items = pedidos.map((pedido) => {
        return dom.crearItemPago(pedido);
    });

    contenedorPedidos.replaceChildren(...items);

    const subtotalLabel = document.querySelector("#subtotal");
    const totalLabel = document.querySelector("#total");

    const subtotal = pedidos.reduce((acumulador, pedido) => {
        return acumulador + pedido.precio * pedido.cantidad;
    }, 0);

    subtotalLabel.textContent = `$${subtotal}`;
    totalLabel.textContent = `$${subtotal + 5000}`;

    // logica de pago

    const btnConfirmarPago = document.querySelector("#btn-confirmar");

    btnConfirmarPago.addEventListener("click", async (e) => {
        const respuesta = await dataPedido.confirmarPedido();

        if (respuesta.status == 200) {
            swal.fire({
                title: "Compra realizada",
                text: "Revisa tu seccion de pedidos para hacer seguimiento de tus compras",
                icon: "success",
            }).then((respuesta) => {
                e.target.disabled;
                if (respuesta.isConfirmed) {
                    localStorage.clear();

                    setTimeout(() => {
                        window.location.replace("shop.php");
                    }, 1000);
                }
            });
        }
    });
}
