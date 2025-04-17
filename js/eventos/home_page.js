//Aqui se añaden los eventos y logica dela pagina en el DOM
export function renderizarIndex() {
    // Codigo para aplicar las transiciones al cargar la pagina
    const productos = document.querySelectorAll(".fade-in");
    const elementos = document.querySelectorAll(".fade-opacity");

    const observer = new IntersectionObserver(
        (productosObservados) => {
            productosObservados.forEach((producto, i) => {
                if (producto.isIntersecting) {
                    const productoVisible = producto.target;
                    productoVisible.style.transitionDelay = `${i * 0.2}s`;
                    productoVisible.classList.add("show");

                    observer.unobserve(producto.target);
                }
            });
        },
        { threshold: 0.2 },
    );

    productos.forEach((producto) => {
        observer.observe(producto);
    });

    elementos.forEach(element => {
        element.classList.add("show");
    });

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
}
