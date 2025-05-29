import { responsive } from "./responsive.js";
import { dataPromo } from "../ajax/data_promo.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";

export async function renderPromocion() {
    responsive();

    const modalPromo = document.querySelector("#modal-promo");
    const formPromo = document.querySelector("#form-promo");

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

    formPromo.addEventListener("submit", async (e) =>{
        e.preventDefault();
        const promoFormData = new FormData(formPromo);
        const idPromo = e.target.getAttribute("id-promo")
        promoFormData.append("id", idPromo);

        const respuesta = await dataPromo.editarPromo(promoFormData);
        console.log(respuesta);

    })
}
