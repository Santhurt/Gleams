import { dom } from "../componentes/shop_componentes.js";
import { dataPedido } from "../ajax/data_pedidos.js";
import { cargarProductos } from "./cargar_productos.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";

export function renderCarrito() {
    const modalCarrito = document.querySelector("#rightModal");
    const listaPedidos = document.querySelector("#lista-pedidos");
    const totalLabel = document.querySelector("#total");
    const confirmarCompra = document.querySelector("#confirmar-compra");

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

    confirmarCompra.addEventListener("click", async (e) => {
        e.preventDefault();
        const respuestas = await cargarProductos();
        let respuestasOk = true;
        let mensaje;

        respuestas.forEach((respuesta) => {
            if (respuesta.status != 200) {
                mensaje = respuesta.mensaje;
                respuestasOk = false;

            }
        });

        if(!respuestasOk) {
            Toast.fire({
                title: mensaje,
                icon: "error"
            });

            return;
        }


        window.location.replace("pago.php");
    });

    // const modalInstancia = new bootstrap.Modal(modalCarrito);

    let total = 0;
    modalCarrito.addEventListener("show.bs.modal", () => {
        if (Object.keys(localStorage).length === 0) {
            dom.mostrarCarritoVacio();

            return;
        }
        const itemsCarrito = Object.keys(localStorage).map((key) => {
            const pedido = JSON.parse(localStorage.getItem(key));
            total += pedido.precio;

            return dom.crearItemCarrito(pedido);
        });

        listaPedidos.replaceChildren(...itemsCarrito);
        totalLabel.textContent = `$${total}`;

        const quitarCarrito = document.querySelectorAll(".quitar-item");

        quitarCarrito.forEach((item) => {
            item.addEventListener("click", async (e) => {
                const idProducto = e.target.id;
                localStorage.removeItem(idProducto);

                const li = e.target.closest("li");
                li.parentElement.removeChild(li);
                dom.actualizarContadorCarrito();
                dom.verificarCarritoVacio();

                await dataPedido.eliminarDelCarrito(idProducto);
            });
        });
    });
}
