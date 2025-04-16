document.addEventListener("DOMContentLoaded", () => {
    const pagina = window.location.pathname;

    console.log(pagina);
    if (pagina === "index.html" || pagina === "/") {
        import("./eventos/home_page.js").then((modulo) => {
            modulo.renderizarIndex();
        });
    }
});
