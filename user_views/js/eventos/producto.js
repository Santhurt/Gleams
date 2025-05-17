import { dataProductos } from "../ajax/data_productos.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";

export async function renderizarProducto() {
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

    const infoProducto = {
        imagen: document.querySelector("#imagen"),
        titulo: document.querySelector("#titulo"),
        precio: document.querySelector("#precio"),
        descripcion: document.querySelector("#descripcion-texto"),
    };

    const idLabel = document.querySelector("#producto-hidden");
    const id = idLabel.getAttribute("id-producto");

    const respuesta = await dataProductos.traerProducto(id);

    if (respuesta.status != 200) {
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
    const producto = respuesta.datos;
    console.log(producto);

    infoProducto.imagen.src = "../" + producto.ruta;
    infoProducto.titulo.textContent = producto.producto;
    infoProducto.precio.textContent = `${producto.precio}`;
    infoProducto.descripcion.textContent = producto.descripcion;
}
