const url = "../../../controllers/comentarios/";

export const data = {
    eliminarComentario: async (id) => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(url + `eliminar_comentario.php?id=${id}`, {
                signal: controlador.signal,
            });

            if (!respuesta.ok) {
                const error = await respuesta.json();
                throw error;
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
    traerComentarios: async () => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(url + "traer_comentarios_db.php", {
                signal: controlador.signal,
            });

            if (!respuesta.ok) {
                const error = await respuesta.json();
                throw error;
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
