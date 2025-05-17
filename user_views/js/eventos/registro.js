import { data } from "../ajax/data_registro.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";

export async function renderRegitro() {
    const elementosTransicion = document.querySelectorAll(".fade-in");

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
        console.log(respuesta)

        if (respuesta.status == 200) {
            swal.fire({
                title: "Registro completo",
                text: "La cuenta fue creada con exito",
                icon: "success",
            }).then((respuesta) => {
                if (respuesta.isConfirmed) {
                    setTimeout(() => {
                        window.location.replace("login.php");
                    }, 1000);
                }
            });
        } else {
            swal.fire({
                title: "Error",
                text: respuesta.mensaje,
                icon: "error"
            });
        }
    });
}
