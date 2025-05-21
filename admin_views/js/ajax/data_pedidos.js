const url = "../../../controllers/pedidos/";
export const data = {
    traerDetallesPedidos: async (id) => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(`${url}traer_detalles.php?id=${id}`, {
                signal: controlador.signal,
            });

            if (!respuesta.ok) {
                const error = await respuesta.json();
                throw error;
            }

            return await respuesta.json();
        } catch (error) {
            if (error.name == "AbortError") {
                return {
                    status: 500,
                    mensaje: "Tiempo de respuesta agotado",
                };
            }
        } finally {
            clearTimeout(timeOut);
        }
    },
    traerPedidos: async () => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(url + "traer_pedidos_db.php", {
                signal: controlador.signal,
            });

            if (!respuesta.ok) {
                const error = await respuesta.json();
                throw error;
            }

            return await respuesta.json();
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

    cambiarEstado: async (id, estado) => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(
                `${url}cambiar_estado.php?id=${id}&estado=${estado}`,
                {
                    signal: controlador.signal,
                },
            );

            if (!respuesta.ok) {
                const error = await respuesta.json();
                throw error;
            }

            return await respuesta.json();
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
