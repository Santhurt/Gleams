const url = "../../controllers/usuarios/";

export const data = {
    traerRoles: async () => {
        const contr = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(url + "traer_roles.php", {
                signal: contr.signal
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
    traerProductoPorId: async (id) => {
        const contr = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(url + `traer_usuario.php?id=${id}`, {
                signal: contr.signal,
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
    traerUsuarios: async () => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(url + "traer_usuarios.php", {
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

    eliminarUsuario: async (id) => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 10000);

        try {
            const respuesta = await fetch(url + "eliminar_usuario.php", {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ id_usuario: id }),
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

    editarUsuario: async (usuario) => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 1000);
        try {
            const respuesta = await fetch(url + "editar_usuario.php", {
                method: "POST",
                body: usuario,
                signal: controlador.signal,
            });

            if (!respuesta.ok) {
                const mensaje = await respuesta.json();
                throw mensaje;
            }

            return {
                status: 200,
                usuarioEditado: await respuesta.json()
            }
        } catch (error) {
            if(error.name == "AbortError") {
                return {
                    status: 500,
                    mensaje: "Tiempo agotado" 
                }
            }

            return error;
        } finally {
            clearTimeout(timeOut);
        }
    },
};
