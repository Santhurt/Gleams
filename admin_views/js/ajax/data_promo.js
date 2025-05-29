const url = "../../../controllers/promos/";
export const dataPromo = {
    editarPromo: async (datos) => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(url + `editar_promo.php`, {
                method: "POST",
                body: datos,
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

    traerPromoPorId: async (id) => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(url + `traer_promo.php?id=${id}`, {
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
