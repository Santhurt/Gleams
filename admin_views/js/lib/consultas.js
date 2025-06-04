const url = "../../../controllers/consultas/";

export const consultar = {
    pedidos: async (consulta) => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(
                `${url}pedidos.php?consulta=${consulta}`,
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
