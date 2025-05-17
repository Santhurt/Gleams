const url = "../../../controllers/usuarios/";

export const data = {
    crearUsuario: async (producto) => {
        const controlador = new AbortController();
        const timeOut = setTimeout(() => controlador.abort(), 1000);
        try {
            const respuesta = await fetch(url + "crear_usuario.php", {
                method: "POST",
                body: producto,
                signal: controlador.signal,
            });

            if (!respuesta.ok) {
                const mensaje = await respuesta.json();
                throw mensaje;
            }

            return {
                status: 200,
                datos: await respuesta.json()
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
