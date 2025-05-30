import { dataProductos } from "../ajax/data_productos.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";
import { dom } from "../componentes/shop_componentes.js";
import { renderCarrito } from "./carrito.js";
import { dataPromos } from "../ajax/data_promos.js";

//Aqui se añaden los eventos y logica dela pagina en el DOM
export async function renderizarIndex() {
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

    const filterHeaders = document.querySelectorAll(".filter-header");
    filterHeaders.forEach((header) => {
        header.addEventListener("click", function () {
            const arrow = this.querySelector("svg");
            if (this.getAttribute("aria-expanded") === "true") {
                arrow.style.transform = "rotate(0deg)";
            } else {
                arrow.style.transform = "rotate(-180deg)";
            }
        });
    });

    // -------------- renderizado del cartel -------------------------
    const respuestaPromos = await dataPromos.traerPromos();

    if (respuestaPromos.status != 200) {
        Toast.fire({
            title: respuestaPromos.mensaje,
            icon: "error",
        });

        return;
    }

    const promos = respuestaPromos.datos;

    const cartel1 = document.querySelector("#cartel-1");
    const tituloCartel1 = document.querySelector("#titulo-cartel-1");
    const textoCartel1 = document.querySelector("#texto-cartel-1");

    const cartel2 = document.querySelector("#cartel-2");
    const tituloCartel2 = document.querySelector("#titulo-cartel-2");
    const textoCartel2 = document.querySelector("#texto-cartel-2");

    let rutaCartel1 = "";
    let rutaCartel2 = "";

    promos.forEach((promo) => {
        if (promo.id_promocion == 1) {
            rutaCartel1 = `../../../${promo.ruta}`;
            tituloCartel1.innerHTML = promo.titulo;
            textoCartel1.innerHTML = promo.descripcion;
        } else if (promo.id_promocion == 2) {
            rutaCartel2 = `../../../${promo.ruta}`;
            tituloCartel2.innerHTML = promo.titulo;
            textoCartel2.innerHTML = promo.descripcion;
        }
    });

    if (rutaCartel1) {
        cartel1.src = rutaCartel1;
    }
    if (rutaCartel2) {
        cartel2.src = rutaCartel2;
    }

    // --------------------renderizado de productos -----------------------------------

    const respuesta = await dataProductos.traerProductos();

    if (respuesta.status !== 200) {
        Toast.fire({
            title: respuesta.mensaje,
            icon: "error",
        });

        return;
    }

    const contenedorProductos = document.querySelector("#contenedor-productos");
    const productos = respuesta.datos;
    console.log(productos);

    const cardProductos = productos.map((producto) => {
        return dom.crearCardProducto(producto);
    });

    const elementos = document.querySelectorAll(".fade-opacity");

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

    cardProductos.forEach((producto) => {
        observer.observe(producto);
    });

    elementos.forEach((element) => {
        element.classList.add("show");
    });

    contenedorProductos.replaceChildren(...cardProductos);

    const inputBuscar = document.querySelector("#buscar");

    inputBuscar.addEventListener("input", (e) => {
        const input = e.target.value;
        const items = document.querySelectorAll(".item-producto");

        items.forEach((item) => {
            const nombre = item.querySelector("#nombre-producto");

            if (!nombre.textContent.includes(input.trim())) {
                item.style.display = "none";
            } else {
                item.style.display = "block";
            }
        });
    });

    dom.actualizarContadorCarrito();

    // ---------------- renderizar en el carrito----------------------------

    renderCarrito();
}
