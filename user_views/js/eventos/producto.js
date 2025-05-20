import { dataProductos } from "../ajax/data_productos.js";
import { dataPedido } from "../ajax/data_pedidos.js";
import swal from "../../../node_modules/sweetalert2/dist/sweetalert2.esm.all.js";
import {renderCarrito} from "./carrito.js";


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
        cantidad: document.querySelector("#input-cantidad"),
    };

    const botonesCantidad = document.querySelectorAll(".btn-cantidad");

    botonesCantidad.forEach((boton) => {
        boton.addEventListener("click", (e) => {
            if (e.target.dataset.op == "agregar") {
                infoProducto.cantidad.value++;
                //el prettier piensa que esto se ve bien ...
            } else if (
                e.target.dataset.op == "restar" &&
                infoProducto.cantidad.value > 1
            ) {
                infoProducto.cantidad.value--;
            }
        });
    });

    //renderizar el contenido del producto en la pagina
    const idLabel = document.querySelector("#producto-hidden");
    const idProducto = idLabel.getAttribute("id-producto");

    const respuesta = await dataProductos.traerProducto(idProducto);

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

    infoProducto.imagen.src = "../" + producto.ruta;
    infoProducto.titulo.textContent = producto.producto;
    infoProducto.precio.textContent = `$${producto.precio}`;
    infoProducto.descripcion.textContent = producto.descripcion;

    // ----------------cargar en el local stotage------------------------
    const contenedorBotones = document.querySelector("#contenedor-botones");

    contenedorBotones.addEventListener("click", async (e) => {
        if (e.target.classList.contains("agregar")) {
            const pedido = {
                id: idProducto,
                nombre: producto.producto,
                precio: producto.precio,
                cantidad: infoProducto.cantidad.value,
            };

            localStorage.setItem(idProducto, JSON.stringify(pedido));

            const respuesta = await dataPedido.agregarAlCarrito(idProducto, pedido.cantidad);
            console.log(respuesta);

            swal.fire({
                title: "Producto agregado al carrito",
                icon: "success",
                confirmButtonText: "Continuar",
            });
        }
    });

    // ---------------- renderizar en el carrito----------------------------

    renderCarrito();

}
