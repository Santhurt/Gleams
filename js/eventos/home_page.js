//Aqui se añaden los eventos y logica dela pagina en el DOM
export function renderizarIndex() {
    // Codigo para aplicar las transiciones al cargar la pagina
    const productos = document.querySelectorAll(".fade-in");
    const heroSection = document.querySelector("#hero-section");


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
        { threshold: 0.3 },
    );

    productos.forEach((producto) => {
        observer.observe(producto);
    });

    heroSection.classList.add("show")

    

}
