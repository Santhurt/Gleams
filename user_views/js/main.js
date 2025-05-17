document.addEventListener("DOMContentLoaded", () => {
    const pagina = window.location.pathname;
    console.log(window.location);

    console.log(pagina);
    if (pagina.includes("/user_views/shop.php")) {
        import("./eventos/home_page.js").then((modulo) => {
            modulo.renderizarIndex();
        });
    } else if (pagina.includes("/user_views/producto.php")) {
        import("./eventos/producto.js").then((modulo) => {
            modulo.renderizarProducto();
        });
    } else if (pagina.includes("/user_views/login.php")) {
        import("./eventos/login.js").then((modulo) => {
            modulo.renderLogin();
        });
    } else if (pagina.includes("/user_views/registro.php")) {
        import("./eventos/registro.js").then((modulo) => {
            modulo.renderRegitro();
        });
    }
});
