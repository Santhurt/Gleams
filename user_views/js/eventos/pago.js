import { dataPedido } from "../ajax/data_pedidos.js";

export async function renderPago() {
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

    const contenedorPedidos = document.querySelector("#contenedor-productos");

    const respuesta = await dataPedido.traerPedidos();
    console.log(respuesta);
}
