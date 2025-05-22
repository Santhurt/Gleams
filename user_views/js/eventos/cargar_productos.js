import { dataPedido } from "../ajax/data_pedidos.js";

export async function cargarProductos() {
    if (localStorage.length > 0) {
        const resultados = await Promise.all(
            Object.keys(localStorage).map(async (key) => {
                const pedido = JSON.parse(localStorage.getItem(key));

                return dataPedido.agregarAlCarrito(key, pedido.cantidad);
            }),
        );
    }
}
