document.addEventListener("DOMContentLoaded", () => {
    const pagina = window.location.pathname;

    console.log(pagina);
    if (pagina === "index.html" || pagina === "/") {
        import("./eventos/home_page.js").then((modulo) => {
            modulo.renderizarIndex();
        });
    } else if (pagina === "/producto.html") {
        import("./eventos/producto.js").then((modulo) => {
            modulo.renderizarProducto();
        });
    } else if (pagina == "/login.html") {
        import("./eventos/login.js").then((modulo) => {
            modulo.renderLogin();
        });
    }
});
