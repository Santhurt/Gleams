document.addEventListener("DOMContentLoaded", () => {
    const pagina = window.location.pathname;

    console.log(pagina);
    if (pagina === "index.php" || pagina === "/") {
        import("./eventos/home_page.js").then((modulo) => {
            modulo.renderizarIndex();
        });
    } else if (pagina === "/producto.php") {
        import("./eventos/producto.js").then((modulo) => {
            modulo.renderizarProducto();
        });
    } else if (pagina == "/login.php") {
        import("./eventos/login.js").then((modulo) => {
            modulo.renderLogin();
        });
    }
});
