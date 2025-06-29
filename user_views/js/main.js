document.addEventListener("DOMContentLoaded", () => {
    const pagina = window.location.pathname;

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
    } else if (pagina.includes("/user_views/pago.php")) {
        import("./eventos/pago.js").then((modulo) => {
            modulo.renderPago();
        });
    } else if (pagina.includes("/user_views/perfil.php")) {
        import("./eventos/perfil.js").then((modulo) => {
            modulo.renderPerfil();
        });
    } else if (pagina.includes("/user_views/pedidos.php")) {
        import("./eventos/pedidos.js").then((modulo) => {
            modulo.renderPedidos();
        });
    } else if (pagina.includes("/user_views/recuperacion.php")) {
        import("./eventos/recuperacion.js").then((modulo) => {
            modulo.renderRecuperacion();
        });
    } else if (pagina.includes("/user_views/recuperar.php")) {
        import("./eventos/recuperacion.js").then((modulo) => {
            modulo.renderRecuperacion();
        });
    }
});
