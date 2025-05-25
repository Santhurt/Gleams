import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";
import { dataPerfil } from "../ajax/data_perfil.js";
import { dom } from "../componentes/shop_componentes.js";
import { renderCarrito } from "./carrito.js";

export async function renderPerfil() {
    // configuracion pal toast
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

    const botonMostrarPass = document.querySelectorAll(".pass");
    botonMostrarPass.forEach((boton) => {
        boton.addEventListener("click", () => {
            const icon = boton.querySelector("i");
            const input = boton.previousElementSibling;

            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            }
        });
    });

    const infoUsuario = {
        header: document.querySelector("#nombre-header"),
        nombre: document.querySelector("#nombre"),
        correo: document.querySelector("#correo"),
        telefono: document.querySelector("#telefono"),
        fecha: document.querySelector("#fecha"),
        direccion: document.querySelector("#direccion"),
        password: document.querySelector("#password-modal"),
    };

    const respuesta = await dataPerfil.traerUsuarioSesion();

    if (respuesta.status != 200) {
        Toast.fire({
            title: respuesta.mensaje,
            icon: "error",
        });
        return;
    }

    const usuario = respuesta.datos;
    console.log(usuario);

    infoUsuario.header.textContent = usuario.nombre;
    infoUsuario.nombre.value = usuario.nombre;
    infoUsuario.correo.value = usuario.correo;
    infoUsuario.telefono.value = usuario.telefono;
    infoUsuario.fecha.value = usuario["fecha de registro"];
    infoUsuario.direccion.value = usuario.direccion;

    // actualizar informacion

    const formUsuario = document.querySelector("#form-usuario");

    formUsuario.addEventListener("submit", async (e) => {
        e.preventDefault();
        const { value: password } = await swal.fire({
            title: "Confirmar contraseña",
            input: "password",
            showCancelButton: true,
            inputPlaceholder: "Ingresa tu contraseña",
            confirmButtonText: "Guardar cambios",
            cancelButtonText: "Cancelar",
            inputAttributes: {
                maxlength: "10",
                autocapitalize: "off",
                autocorrect: "off",
            },
            customClass: {
                input: "modal-input",
                validationMessage: "my-validation-message",
                confirmButton: "boton-fondo-morado",
                cancelButton: "boton-fondo-blanco",
            },
            preConfirm: (value) => {
                if (!value) {
                    swal.showValidationMessage(
                        '<i class="fa fa-info-circle"></i> Ingresa la contraseña',
                    );
                }
            },
        });

        if (!password) return;
        infoUsuario.password.value = password;
        formUsuario.submit();
    });

    dom.actualizarContadorCarrito();

    // ---------------- renderizar en el carrito----------------------------

    renderCarrito();
}
