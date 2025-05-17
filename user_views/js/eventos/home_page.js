import { dataProductos } from "../ajax/data_productos.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";
import { dom } from "../componentes/shop_componentes.js";

//Aqui se añaden los eventos y logica dela pagina en el DOM
export async function renderizarIndex() {
    // Codigo para aplicar las transiciones al cargar la pagina
    // Animación para las flechas de los acordeones
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

    const respuesta = await dataProductos.traerProductos();

    if (respuesta.status !== 200) {
        swal.fire({
            title: "Error",
            text: respuesta.mensaje,
            icon: "error",
            confirmButtonText: "Continuar",
            // customClass: {
            //     confirmButton: "btn btn-info",
            // },
        });

        return;
    }

    // --------------------renderizado de productos -----------------------------------

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
}
