import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";
import { dataPedido } from "../ajax/data_pedidos.js";
import { dom } from "../componentes/shop_componentes.js";
import { cargarProductos } from "./cargar_productos.js";

export async function renderPago() {
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
    console.log(respuesta);

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

    //--------------- logica de pago

    const btnConfirmarPago = document.querySelector("#btn-confirmar");

    btnConfirmarPago.addEventListener("click", async (e) => {
        const respuesta = await dataPedido.confirmarPedido();

        if (respuesta.status == 200) {
            swal.fire({
                title: "Compra realizada",
                text: "Revisa tu seccion de pedidos para hacer seguimiento de tus compras",
                confirmButtonText: "Continuar",
                icon: "success",
                customClass: {
                   confirmButton: "boton-fondo-morado"
                }
            }).then((respuesta) => {
                e.target.disabled;
                if (respuesta.isConfirmed) {
                    btnConfirmarPago.classList.add("disabled");
                    localStorage.clear();

                    setTimeout(() => {
                        window.location.replace("shop.php");
                    }, 1000);
                }
            });
        } else {
            Toast.fire({
                title: respuesta.mensaje,
                icon: "error",
            });
        }
    });
}
