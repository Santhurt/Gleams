import { dataProductos } from "../ajax/data-productos.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";

export function domicilio() {
    document
        .querySelector("#editar-domicilio")
        .addEventListener("click", async function () {
            // 1. Obtener referencias a los elementos
            const inputMonto =
                this.closest(".d-flex").querySelector('input[type="text"]');
            const boton = this; // 'this' es el botón con id="editar-domicilio"

            // --- LÓGICA DE CAMBIO DE ESTADO ---

            // Si el botón dice "Editar", cambiamos a modo edición
            if (boton.textContent === "Editar") {
                // 1. Cambiar el botón a modo "Guardar"
                boton.textContent = "Guardar";
                boton.classList.remove("btn-primary");
                boton.classList.add("btn-success"); // Mejor un color verde para Guardar

                // 2. Habilitar el input
                inputMonto.removeAttribute("disabled");
                inputMonto.focus(); // Opcional: enfoca el input para edición inmediata
            }

            // Si el botón dice "Guardar", cambiamos a modo visualización (y enviamos AJAX)
            else if (boton.textContent === "Guardar") {
                // --- 3. Ejecutar la Petición AJAX (Simulación) ---

                // Prevenir el envío normal del formulario (si cambiaste el type a submit)
                // Ya que estamos dentro de un listener del botón, podemos manejar la lógica aquí.

                const nuevoMonto = inputMonto.value;
                const respuesta =
                    await dataProductos.editarDomiclio(nuevoMonto);

                if (respuesta.status != 200) {
                    swal.fire({
                        title: "Error",
                        text: respuesta.mensaje,
                        icon: "error",
                        confirmButtonText: "Continuar",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    });

                    return;
                }

                revertirEstado();
            }

            // Función para revertir el estado después de una acción exitosa (AJAX)
            function revertirEstado() {
                // 4. Volver al estado "Editar"
                boton.textContent = "Editar";
                boton.classList.remove("btn-success");
                boton.classList.add("btn-primary");

                // 5. Deshabilitar el input
                inputMonto.setAttribute("disabled", "disabled");
            }
        });
}
