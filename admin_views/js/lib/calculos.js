import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";

function mostrarAlert(respuesta) {
    swal.fire({
        title: "Error",
        text: respuesta.mensaje,
        icon: "error",
        confirmButtonText: "Continuar",
        customClass: {
            confirmButton: "btn btn-primary",
        },
    });
}

export const calcular = {
    usuariosRegistrados: async function () {
        return import("../ajax/data_usuarios.js").then(async (modulo) => {
            const respuesta = await modulo.dataUsuarios.traerUsuarios();

            if (respuesta.status == 500) {
                mostrarAlert(respuesta);

                return 0;
            }

            return respuesta.length;
        });
    },

    totalVentas: async function () {
        return import("../ajax/data_pedidos.js").then(async (modulo) => {
            const respuesta = await modulo.dataPedidos.traerPedidos();
            console.log(respuesta);

            if (respuesta.status != 200) {
                mostrarAlert(respuesta);

                return 0;
            }

            const datos = respuesta.datos;

            const totalVentas = datos.reduce((suma, pedido) => {
                return suma + pedido.total;
            }, 0);

            return totalVentas;
            
        });
    },
};
