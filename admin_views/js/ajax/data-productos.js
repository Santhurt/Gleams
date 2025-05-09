const url = "../../controllers/productos/";
export const data = {
    insertarProducto: async (empleado) => {
        try {
            const respuesta = await fetch(url + "crear_producto.php", {
                method: "POST",
                body: empleado,
            });

            if (!respuesta.ok) {
                const error = await respuesta.json();
                throw error;
            }

            return respuesta.json();
        } catch (error) {
            return error;
        }
    },

    traerCategorias: async () => {
        try {
            const respuesta = await fetch(url + "traer_categorias.php");

            if(!respuesta.ok) {
                const error = await respuesta.json();
                throw error;
            }

            return respuesta.json();
        } catch (error) {
            return error;
        }
    }
};
