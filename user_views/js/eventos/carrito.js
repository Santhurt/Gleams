import {dom} from "../componentes/shop_componentes.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";

export function renderCarrito() {
    const modalCarrito = document.querySelector("#rightModal");
    const listaPedidos = document.querySelector("#lista-pedidos");
    const totalLabel = document.querySelector("#total");

    const modalInstancia = new bootstrap.Modal(modalCarrito);

    let total = 0;
    modalCarrito.addEventListener("show.bs.modal", (e) => {
        const itemsCarrito = Object.keys(localStorage).map((key) => {
            const pedido = JSON.parse(localStorage.getItem(key));
            total += pedido.precio;

            return dom.crearItemCarrito(pedido);
        });

        listaPedidos.replaceChildren(...itemsCarrito);
        totalLabel.textContent = `$${total}`;
    });

    const confirmarCompra = document.querySelector("#confirmar-compra");
    confirmarCompra.addEventListener("click", ()=>{
        swal.fire({
            title: "Confirma compra",
            text: `Total de la compra: ${total}`,
            icon: "question"
        })
    })

}
