import { dataProductos } from "../ajax/data_productos.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";
import { dom } from "../componentes/shop_componentes.js";
import { renderCarrito } from "./carrito.js";

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

    const respuesta = await dataProductos.traerProductos();

    if (respuesta.status !== 200) {
        Toast.fire({
            title: respuesta.mensaje,
            icon: "error"
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

    const inputBuscar = document.querySelector("#buscar");

    inputBuscar.addEventListener("input", (e)=>{
        const input = e.target.value;
        const items = document.querySelectorAll(".item-producto");

        items.forEach(item => {
            const nombre = item.querySelector("#nombre-producto");

            if(!nombre.textContent.includes(input.trim())) {
                item.style.display = "none";
            } else {
                item.style.display = "block";

            }

        });

    })

    dom.actualizarContadorCarrito();

    // ---------------- renderizar en el carrito----------------------------

    renderCarrito();

}
