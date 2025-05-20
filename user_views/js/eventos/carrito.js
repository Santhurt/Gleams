import { dom } from "../componentes/shop_componentes.js";
import { dataPedido } from "../ajax/data_pedidos.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";

export function renderCarrito() {
    const modalCarrito = document.querySelector("#rightModal");
    const listaPedidos = document.querySelector("#lista-pedidos");
    const totalLabel = document.querySelector("#total");

    // const modalInstancia = new bootstrap.Modal(modalCarrito);

    let total = 0;
    modalCarrito.addEventListener("show.bs.modal", () => {
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

                const respuesta =
                    await dataPedido.eliminarDelCarrito(idProducto);

                if (respuesta.status != 200) {
                    swal.fire({
                        title: "Error al eliminar",
                        text: respuesta.mensaje,
                    });
                } else {
                    const li = e.target.closest("li");
                    li.parentElement.removeChild(li);
                }
            });
        });
    });
}
