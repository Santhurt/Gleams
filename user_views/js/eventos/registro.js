import { data } from "../ajax/data_registro.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";

export async function renderRegitro() {
    const elementosTransicion = document.querySelectorAll(".fade-in");

    const Toast = swal.mixin({
        toast: true,
        position: "top-end",
        iconColor: "white",
        customClass: {
            popup: "colored-toast",
        },
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
    });

    const observer = new IntersectionObserver(
        (observados) => {
            observados.forEach((observado, i) => {
                if (observado.isIntersecting) {
                    const elementoVisible = observado.target;
                    elementoVisible.style.transitionDelay = `${i * 0.2}s`;
                    elementoVisible.classList.add("show");

                    observer.unobserve(observado.target);
                }
            });
        },
        { threshold: 0.2 },
    );

    elementosTransicion.forEach((elemento) => {
        observer.observe(elemento);
    });

    //---------evento de registro --------------

    const formRegistro = document.querySelector("#form-registro");

    formRegistro.addEventListener("submit", async (e) => {
        e.preventDefault();

        const usuario = new FormData(formRegistro);
        const respuesta = await data.crearUsuario(usuario);

        if (respuesta.status == 200) {
            Toast.fire({
                title: "Registro exitoso",
                icon: "success",
            }).then(() => {
                setTimeout(() => {
                    window.location.replace("login.php");
                }, 500);
            });
        } else {
            Toast.fire({
                title: respuesta.mensaje,
                icon: "error"
            });
        }
    });
}
