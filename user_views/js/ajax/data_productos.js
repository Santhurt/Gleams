const url = "../../../controllers/productos/";
const urlComentario =  "../../../controllers/comentarios/"

export const dataProductos = {
    traerComentarioProducto: async (id) => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(urlComentario + `traer_comentarios.php?id=${id}`, {
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
    crearComentario: async (comentario) => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(urlComentario + "crear_comentario.php", {
                method: "POST",
                body: comentario,
                signal: controlador.signal,
            });

            if (!respuesta.ok) {
                const mensaje = await respuesta.json();
                throw mensaje;
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
    traerProductos: async () => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(url + "traer_productos.php", {
                signal: controlador.signal,
            });

            if (!respuesta.ok) {
                const mensaje = await respuesta.json();
                throw mensaje;
            }

            return {
                status: 200,
                datos: await respuesta.json(),
            };
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

    traerProducto: async (id) => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(url + `traer_producto.php?id=${id}`, {
                signal: controlador.signal,
            });

            if (!respuesta.ok) {
                const mensaje = await respuesta.json();
                throw mensaje;
            }

            return {
                status: 200,
                datos: await respuesta.json(),
            };
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
