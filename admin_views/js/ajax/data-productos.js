const url = "../../controllers/productos/";
export const dataProductos = {
    insertarDescuento: async (descuento) => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(url + `crear_descuento.php`, {
                method: "POST",
                body: descuento,
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
    traerProductoPorId: async (id) => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(`${url}traer_producto.php?id=${id}`, {
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
    insertarProducto: async (empleado) => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(url + "crear_producto.php", {
                method: "POST",
                body: empleado,
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
            return {
                ok: false,
                error: error,
            };
        } finally {
            clearTimeout(timeOut);
        }
    },

    traerCategorias: async () => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(url + "traer_categorias.php", {
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

    traerProductos: async () => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(url + "traer_productos.php", {
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

    editarProducto: async (producto) => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(url + "editar_producto.php", {
                method: "POST",
                body: producto,
            });

            if (!respuesta.ok) {
                const error = await respuesta.json();
                throw error;
            }
            return respuesta.json();
        } catch (error) {
            if (error.name == "AbortError") {
                return { ok: false, mensaje: "Tiempo de espera agotado" };
            }

            console.log("errrrrrr");
            console.log(error);

            return {
                ok: false,
                mensaje: error.mensaje,
            };
        } finally {
            clearTimeout(timeOut);
        }
    },

    eliminarProducto: async (id) => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(url + "eliminar_producto.php", {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ id_producto: id }),
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
};
