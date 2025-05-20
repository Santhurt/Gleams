import {dom} from "../componentes/shop_componentes.js";

export function renderCarrito() {
    const modalCarrito = document.querySelector("#rightModal");
    const listaPedidos = document.querySelector("#lista-pedidos");
    const totalLabel = document.querySelector("#total");

    const modalInstancia = new bootstrap.Modal(modalCarrito);

    let total = 0;
    modalCarrito.addEventListener("show.bs.modal", () => {
        const itemsCarrito = Object.keys(localStorage).map((key) => {
            const pedido = JSON.parse(localStorage.getItem(key));
            total += pedido.precio;

            return dom.crearItemCarrito(pedido);
        });

        listaPedidos.replaceChildren(...itemsCarrito);
        totalLabel.textContent = `$${total}`;
    });

}
