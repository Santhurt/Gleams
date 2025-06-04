import { responsive } from "./responsive.js";
import { consultar } from "../lib/consultas.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";

export async function renderDashboard() {
    responsive();
    const cantidadLabel = document.querySelector("#cantidad-usuarios");
    const totalVentasLabel = document.querySelector("#total-ventas");
    const totalDia = document.querySelector("#total-dia");

    const consultas = [
        consultar.pedidos("ventas_mes"),
        consultar.pedidos("ventas_dia"),
        consultar.pedidos("cant_usuarios"),
    ];

    try {
        const [ventasMes, ventasDia, cantUsuarios] =
            await Promise.all(consultas);

        if (
            ventasMes.status !== 200 ||
            ventasDia.status !== 200 ||
            cantUsuarios.status !== 200
        ) {
            if (ventasMes.status !== 200)
                mostrarAlert("Error en ventas del mes: " + ventasMes.mensaje);
            if (ventasDia.status !== 200)
                mostrarAlert("Error en ventas del día: " + ventasDia.mensaje);
            if (cantUsuarios.status !== 200)
                mostrarAlert(
                    "Error en cantidad de usuarios: " + cantUsuarios.mensaje,
                );
            return;
        }

        totalVentasLabel.innerHTML = `$${ventasMes.datos["ventas_mensuales"] ?? 0}`;
        totalDia.innerHTML = `$${ventasDia.datos["ventas_diarias"] ?? 0}`;
        cantidadLabel.innerHTML = `${cantUsuarios.datos["total_usuarios"] ?? 0}`;
    } catch (error) {
        mostrarAlert("Ocurrió un error general en el dashboard");
        console.error(error);
    }
}

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
