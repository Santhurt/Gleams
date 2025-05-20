const url = "../../../controllers/pedidos/";

export const dataPedido = {
    agregarAlCarrito: async (id, cantidad) => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(url + `agregar_pedido.php?id=${id}&cantidad=${cantidad}`, {
                signal: controlador.signal,
            });

            if (!respuesta.ok) {
                const mensaje = await respuesta.json();
                throw mensaje;
            }

            return respuesta.json();
        } catch (error) {
            if (error.name == "AbortError") {
                return {
                    status: 500,
                    mensaje: "Tiempo de respuesta agotado",
                };
            }
            return error;
        } finally {
            clearTimeout(timeOut);
        }
    },
};
