import { responsive } from "./responsive.js";
import { dataPromo } from "../ajax/data_promo.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";

export async function renderPromocion() {
    responsive();

    const modalPromo = document.querySelector("#modal-promo");
    const modalInstancia = new bootstrap.Modal(modalPromo);
    const formPromo = document.querySelector("#form-promo");

    //Renderixado de las promociones
    //
    const respuesta = await dataPromo.traerPromos();

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

    const promos = respuesta.datos;

    const imagen1 = document.querySelector("#imagen-1");
    const imagen2 = document.querySelector("#imagen-2");

    // Inicialmente no establecer src
    let ruta1 = "";
    let ruta2 = "";

    promos.forEach((promo) => {
        if (promo.id_promocion == 1) {
            ruta1 = `../../../${promo.ruta}`;
        } else if (promo.id_promocion == 2) {
            ruta2 = `../../../${promo.ruta}`;
        }
    });

    // Asignar al final
    if (ruta1) imagen1.src = ruta1;
    if (ruta2) imagen2.src = ruta2;
    modalPromo.addEventListener("show.bs.modal", async (e) => {
        const boton = e.relatedTarget;
        const id = boton.id;

        const respuesta = await dataPromo.traerPromoPorId(id);

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

        const promo = respuesta.datos;

        const titulo = document.querySelector("#titulo");
        const descripcion = document.querySelector("#descripcion");

        titulo.value = promo.titulo;
        descripcion.value = promo.descripcion;
        formPromo.setAttribute("id-promo", boton.id);
    });

    formPromo.addEventListener("submit", async (e) => {
        e.preventDefault();
        const promoFormData = new FormData(formPromo);
        const idPromo = e.target.getAttribute("id-promo");
        promoFormData.append("id", idPromo);

        const respuesta = await dataPromo.editarPromo(promoFormData);

        if (respuesta.status == 200) {
            swal.fire({
                title: "Promoción actualizada",
                icon: "success",
                confirmButtonText: "Continuar",
                customClass: {
                    confirmButton: "btn btn-primary",
                },
            }).then((respuestaModal) => {
                if (respuestaModal.isConfirmed) {
                    const imagen = document.querySelector(`#imagen-${idPromo}`);
                    console.log(respuesta);
                    const ruta = respuesta.datos;

                    imagen.src = `../../../${ruta}`;

                    modalInstancia.hide();
                }
            });
        } else {
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
    });
}
