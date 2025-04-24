document.addEventListener("DOMContentLoaded", () => {
    const pagina = window.location.pathname;

    console.log(pagina);
    if (pagina === "/user_views/shop.php") {
        import("./eventos/home_page.js").then((modulo) => {
            modulo.renderizarIndex();
        });
    } else if (pagina === "/user_views/producto.php") {
        import("./eventos/producto.js").then((modulo) => {
            modulo.renderizarProducto();
        });
    } else if (pagina == "/user_views/login.php") {
        import("./eventos/login.js").then((modulo) => {
            modulo.renderLogin();
        });
    }
});
